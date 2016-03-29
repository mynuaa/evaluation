<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth, App\User, App\Apply, App\Http\Requests\ApplyPostRequest;

use App\Services\HtmlAttributeFilter;

use Input, App\Recommendation, App\Http\Requests\RecommendPostRequest;
use Session;

use Intervention\Image\Facades\Image;

class ApplyController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', ['only' => ['getApply', 'postApply', 'postRecommendation', 'getVote', 'getDelete']]);
	}

	public function getApply(HtmlAttributeFilter $filter)
	{
		$apply = Auth::user()->apply;
		if ($apply->video_url !== null)
			$apply->video_url_arr = explode("\n", $apply->video_url);
		else
			$apply->video_url_arr = [];
		$filter->setAllow(['style']);
		$filter->setException([
			'span' => ['style'],
			'img' => ['src', 'alt', 'title', 'width', 'height', 'border', 'vspace'],
		]);
		$apply->whoami = strip_tags($filter->strip($apply->whoami), '<strong><em><p><span><img>');
		$apply->story = strip_tags($filter->strip($apply->story), '<strong><em><p><span><img>');
		$apply->insufficient = strip_tags($filter->strip($apply->insufficient), '<strong><em><p><span><img>');
		return view('apply.apply')->withApply($apply)->withStuid(Auth::user()->username);
	}

	public function postApply(ApplyPostRequest $request)
	{
		// return view('apply.apply')->withApply(Auth::user()->apply)->withMessage(['type' => 'warning', 'content' => '时间截止，停止申报。']);

		$request->photos = [];
		foreach ($request->file('imgs') as $key => $file) {
			if ($file)
			{
				if ( ! $file->isValid() )
				{
					return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.file.fail')]);
				}
				if (in_array($file->getClientMimeType(), config('business.MIME'))){
					$filename = md5($file->getClientOriginalName().$file->getClientSize()).'.'.$file->getClientOriginalExtension();
					$file->move(storage_path() . '/app/photos', $filename);
					$img = Image::make(storage_path() . '/app/photos/' . $filename)->resize(null, 150, function ($constraint) { $constraint->aspectRatio(); });
					$img->save(storage_path() . '/app/thumbs/' . $filename, 75);
					$request->photos[$key] = $filename;
				}
				else{
					abort(500, trans('message.file.wrong_type'));
				}
			}
		}

		$user = Auth::user();

		$apply = Apply::firstOrNew(['user_id' => $user->id]);

		$apply->type = $request->type;
		$apply->stuid = $user->username;
		$apply->name = Auth::user()->name;
		$apply->college = Auth::user()->college;
		$apply->sex = $request->sex;
		$apply->native_place = $request->native_place;
		$apply->political = $request->political;
		$apply->major = $request->major;
		$apply->title = $request->title;
		$apply->whoami = $request->whoami;
		$apply->story = $request->story;
		$apply->insufficient = $request->insufficient;
		$apply->tag1 = isset($request->tags[0]) ? $request->tags[0] : '';
		$apply->tag2 = isset($request->tags[1]) ? $request->tags[1] : '';
		$apply->tag3 = isset($request->tags[2]) ? $request->tags[2] : '';

		foreach ($request->photos as $key => $photo) {
			$keyname = 'img'.($key+1);
			$apply->$keyname = $photo;
		}

		$apply->intro1 = isset($request->intros[0]) ? $request->intros[0] : '';
		$apply->intro2 = isset($request->intros[1]) ? $request->intros[1] : '';
		$apply->intro3 = isset($request->intros[2]) ? $request->intros[2] : '';

		$apply->video_url = $request->video_url;

		$user->apply()->save($apply);

		return redirect('apply/apply')->withMessage(['type' => 'success', 'content' => trans('message.apply.success')]);
	}

	public function getShow($id, Request $request, HtmlAttributeFilter $filter)
	{
		$apply = Apply::find($id);

		if ($apply){

			$apply->increment('pageview');
			$apply->isRecommended = Auth::check() ? Auth::user()->isRecommended($id) : true;
			$apply->isVoted = Auth::check() ? Auth::user()->isVoted($id) : true;
			$apply->video_url_arr = explode("\n", $apply->video_url);
			$filter->setAllow(['style']);
			$filter->setException([
				'span' => ['style'],
				'img' => ['src', 'alt', 'title', 'width', 'height', 'border', 'vspace'],
			]);
			$apply->whoami = strip_tags($filter->strip($apply->whoami), '<strong><em><p><span><img>');
			$apply->story = strip_tags($filter->strip($apply->story), '<strong><em><p><span><img>');
			$apply->insufficient = strip_tags($filter->strip($apply->insufficient), '<strong><em><p><span><img>');

			return view('apply.show')->withApply($apply)->withIsWechat(
				strstr($request->header('user-agent'), config('business.WeChat_UA')) != false
			);
		}
		else{
			abort(404, 'Application not found.');
		}
	}

	public function postRecommendation(RecommendPostRequest $request)
	{
		// return redirect()->back()->withMessage(['type' => 'warning', 'content' => '时间截止，停止申报。']);

		$user = Auth::user();

		if ($user->isRecommendTooMuch())
		{
			return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.recommend.too_much')]);
		}

		if ($user->isRecommended($request->applyid))
		{
			return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.recommend.before')]);
		}

		$user->recommendations()->attach($request->applyid, ['content' => $request->content]);
		Apply::find($request->applyid)->increment('recommendations');

		$remain = $user->remain();

		return redirect()->back()->withMessage(['type' => 'success', 'content' => trans('message.recommend.success')]);
	}

	public function getVote($id)
	{
		if (Auth::user()->isVoted($id))
		{
			return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.vote.before')]);
		}

		$apply = Apply::find($id);
		$user = Auth::user();

		//院级评选只能本院投票
		if ($apply->type == config('business.type.college')){
			if ($apply->college != $user->college){
				return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.vote.cross_college')]);
			}
		}

		//同学院 || 不同学院
		if ($user->college == $apply->college){
			if ($user->countInner() >= config('business.vote.inner')){
				return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.vote.too_much_inner')]);
			}
		}
		else{
			if ($user->countOuter() >= config('business.vote.outer')){
				return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.vote.too_much_outer')]);
			}
		}

		$user->votes()->attach($id);
		$apply->increment('votes');

		$remain = Auth::user()->remain();

		return redirect()->back()->withMessage([
			'type' => 'success',
			'content' => trans('message.vote.success') . "同学院还可投${remain['inner']}票，不同学院还可投${remain['outer']}票。"
		]);
	}

	public function getLike($id)
	{
		Apply::find($id)->increment('like');
	}

	public function getDelete($id)
	{
		if (Auth::user()->isAdmin())
		{
			Apply::find($id)->delete();

			return redirect('/')->withMessage(['type' => 'success', 'content' => '删除成功 =。=']);
		}
		else
		{
			abort(403, 'Access denied.');
		}
	}
}
