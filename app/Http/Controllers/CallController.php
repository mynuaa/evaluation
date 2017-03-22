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


	public function getMain(){


	}

	public function getCall() {
		$callNum=DB::table('call')->where('toId',2)->count();
		//$db=DB:table('call')->list('id');
		//var_dump(Auth::user()->id);
		return view('call.call')->withDebug('0');
	}


	public function postCall (CallPostRequest $request){

		$insertCall['toId']=$request->id;
		$insertCall['fromId']=Auth::user()->id;
		$insertCall['anonymous']=$request->anonymous?1:0;
		$insertCall['mainText']=$request->reason;

		DB::table('call')->insert($insertCall);
		return redirect()->back()->withMessage(['type' => 'success', 'content' => "揭发成功", 'isAnonymous' => $insertCall['anonymous']]);
	}

}

?>
