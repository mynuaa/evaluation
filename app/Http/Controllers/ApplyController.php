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

		$apply = $user->apply()->first();

		var_dump($apply);

		// $apply = new Apply([			
		// 	'type' => $request['type'],
		// 	'name' => $request['name'],
		// 	'college' => $request['college'],
		// 	'sex' => $request['sex'],
		// 	'native_place' => $request['native_place'],
		// 	'political' => $request['political'],
		// 	'major' => $request['major'],
		// 	'title' => $request['title'],
		// 	'whoami' => $request['whoami'],
		// 	'story' => $request['story'],
		// 	'insufficient' => $request['insufficient'],
		// ]);

		// $user->apply()->save($apply);
	}

}
