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
		return view('apply.apply')->withApply(Auth::user()->apply()->first());
	}

	public function postApply(ApplyPostRequest $request)
	{
		$user = Auth::user();

		$apply = Apply::firstOrNew(['user_id' => $user->id]);
	
		$apply['type'] = $request['type'];
		$apply['stuid'] = Auth::user()->username;
		$apply['name'] = $request['name'];
		$apply['college'] = $request['college'];
		$apply['sex'] = $request['sex'];
		$apply['native_place'] = $request['native_place'];
		$apply['political'] = $request['political'];
		$apply['major'] = $request['major'];
		$apply['title'] = $request['title'];
		$apply['whoami'] = $request['whoami'];
		$apply['story'] = $request['story'];
		$apply['insufficient'] = $request['insufficient'];
		$apply['tag1'] = isset($request['tags'][0]) ? $request['tags'][0] : '';
		$apply['tag2'] = isset($request['tags'][1]) ? $request['tags'][1] : '';
		$apply['tag3'] = isset($request['tags'][2]) ? $request['tags'][2] : '';

		$user->apply()->save($apply);

		return redirect('apply/apply')->withMessage(['type' => 'success', 'content' => trans('message.apply_successed')]);
	}

	public function getShow($id)
	{
		$apply = Apply::find($id);

		if ($apply){
			$apply->increment('pageview');

			$recommendations = $apply->recommendations;

			return view('apply.show')->withApply($apply);
		}
		else{
			abort(404, 'Application not found.');
		}
	}

	public function postRecommendation(RecommendPostRequest $request)
	{
		$apply = Apply::find($request['applyid']);

		Auth::user()->recommendations()->attach($apply, ['content' => Input::get('content')]);

		return redirect('apply/show/'.$request['applyid'])->withMessage(['type' => 'success', 'content' => trans('message.recommend_successed')]);
	}
}
