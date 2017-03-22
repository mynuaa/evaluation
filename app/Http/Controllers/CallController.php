<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth, App\User, App\Apply, App\Http\Requests\CallPostRequest;

use Input, App\Recommendation;
use Session;

class CallController extends Controller {
/*
	public function index() {
		
		return view('call.call')->withText1('23333');
	}*/

	public function getCall() {

		return view('call.call')->withDebug('6');
	}

	public function postCall (CallPostRequest $request){

		$re=$request->name;
		return redirect()->back()->withMessage(['type' => 'success', 'content' => "揭发成功"]);
	}

}

?>
