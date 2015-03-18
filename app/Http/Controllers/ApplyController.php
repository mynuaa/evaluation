<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth, App\User, App\Apply, App\Http\Requests\ApplyPostRequest;

class ApplyController extends Controller {

	public function getApply()
	{
		return view('apply.apply')->withApply(Auth::user()->apply()->first());
	}

	public function postApply(ApplyPostRequest $request)
	{
		$user = Auth::user();

		$apply = Apply::firstOrNew(['user_id' => $user->id]);
	
		$apply['type'] = $request['type'];
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

		$user->apply()->save($apply);

		echo "Apply successed.";
	}

	public function getShow($stuid)
	{
		$apply = Apply::stuid($stuid);

		var_dump($apply->first());
	}
}
