<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth, App\User, App\Apply, App\Http\Requests\ApplyPostRequest;

use Input;

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
		$apply = Apply::stuid($stuid)->first();

		if ($apply){
			var_dump($apply);
		}
		else{
			abort(404, 'This people has no application.');
		}

		return view('apply.show');
	}

	public function getList($type)
	{
		foreach (Apply::type($type)->get() as $apply) {
			var_dump($apply);
		}
	}

	public function postRecommendation(Request $request)
	{
		$refer = $request->header('referer');
		preg_match("/(\d+)$/", $refer, $matches);
		$stuid = $matches[0];

		$apply = Apply::stuid($stuid)->first();
		
		Auth::user()->recommendations()->attach($apply->id, ['content' => Input::get('content')]);

		// var_dump($toUser->recommendations()->first());

		// var_dump($toUser);
		// return Input::get('content');
	}
}
