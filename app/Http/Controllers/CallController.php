<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth, App\User, App\Apply;

use Input;
use Session;

use Illuminate\Http\Request, App\Http\Requests\CallPostRequest;
use DB;

class CallController extends Controller {
/*
	public function index() {
		
		return view('call.call')->withText1('23333');
	}*/

	public function getCall() {
		$db=DB::table('call')->get();
		var_dump($db);
		return view('call.call')->withDebug('0');
	}

	public function postCall (CallPostRequest $request){

		$re=$request->name;
		return redirect()->back()->withMessage(['type' => 'success', 'content' => "揭发成功"]);
	}

}

?>
