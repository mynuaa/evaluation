<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth, App\User, App\Apply;

class ApplyController extends Controller {

	public function getApply()
	{
		return view('apply.apply');//->withApply(Auth::user()->apply()->first());
	}

	public function postApply(ApplyPostRequest $request)
	{
		$user = Auth::user();

		$apply = Apply::create(

		);
	}

}
