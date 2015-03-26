<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth, App\User, App\Apply, App\Http\Requests\ApplyPostRequest;

use Input, App\Recommendation, App\Http\Requests\RecommendPostRequest;
use Session;

class ApplyController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', ['only' => ['getApply', 'postApply', 'postRecommendation']]);
	}

	public function getApply()
	{
		return view('apply.apply')->withApply(Auth::user()->apply)->withStuid(Auth::user()->username);
	}

	public function postApply(ApplyPostRequest $request)
	{
		$user = Auth::user();

		$apply = Apply::firstOrNew(['user_id' => $user->id]);
	
		$apply->type = $request->type;
		$apply->stuid = Auth::user()->username;
		$apply->name = $request->name;
		$apply->college = $request->college;
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
		$apply->img1 = isset($request->imgs[0]) ? $request->imgs[0] : '';
		$apply->img2 = isset($request->imgs[1]) ? $request->imgs[1] : '';
		$apply->img3 = isset($request->imgs[2]) ? $request->imgs[2] : '';
		$apply->intro1 = isset($request->intros[0]) ? $request->intros[0] : '';
		$apply->intro2 = isset($request->intros[1]) ? $request->intros[1] : '';
		$apply->intro3 = isset($request->intros[2]) ? $request->intros[2] : '';

		$user->apply()->save($apply);

		return redirect('apply/apply')->withMessage(['type' => 'success', 'content' => trans('message.apply_successed')]);
	}

	public function getShow($id)
	{
		$apply = Apply::find($id);

		if ($apply){

			$apply->increment('pageview');
			$apply->isRecommended = Auth::user()->isRecommended($id);

			return view('apply.show')->withApply($apply);
		}
		else{
			abort(404, 'Application not found.');
		}
	}

	public function postRecommendation(RecommendPostRequest $request)
	{		
		$recommendations = Auth::user()->recommendations();

		if ($recommendations->where('apply_id', $request->applyid)->exists())
		{
			return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.recommend_before')]);
		}
		if ($recommendations->count() >= config('business.recommend.max'))
		{
			return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.recommend_too_much')]);
		}

		$recommendations->attach($request->applyid, ['content' => $request->content]);

		return redirect()->back()->withMessage(['type' => 'success', 'content' => trans('message.recommend_successed')]);
	}

	public function getVote($id)
	{
		$votes = Auth::user()->votes();

		if ($votes->where('apply_id', $id)->exists())
		{
			return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.voted_before')]);
		}
		if ($votes->count() >= config('business.vote.max'))
		{
			return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.vote_too_much')]);
		}

		$votes->attach($id);

		return redirect()->back()->withMessage(['type' => 'success', 'content' => trans('message.vote_successed')]);
	}
}
