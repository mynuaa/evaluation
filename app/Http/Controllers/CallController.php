<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth, App\User, App\Call;

use Input;
use Session;

use Illuminate\Http\Request, App\Http\Requests\CallPostRequest, App\Http\Requests\CallLikePostRequest;
use DB;

class CallController extends Controller {
/*
	public function index() {
		
		return view('call.call')->withText1('23333');
	}*/


	public function getMain(){
		//$allCall=DB::table('call')->lists('toId');
		$heHas=Call::where('toId','=',1)->count();
		$allCall=Call::select('toId',DB::raw('COUNT(*) AS `cnt`'))->groupBy('toId')->orderBy('cnt','desc')->get();
		$callNum=$allCall->count();
		/*
		foreach ($allCall as $key => $value) {
			echo $value['original']['toId']." ".$value['original']['cnt']."\n";
		}*/

		return view('call.main')->withAllcall($allCall)->withDebug('0');

	}

	public function getCall() {
		if(!isset(Auth::user()->username)){
			return redirect()->back()->withMessage(['type' => 'warning', 'content' => '请登陆']);
		}

		//$db=DB:table('call')->list('id');
		//var_dump(Auth::user()->id);
		//var_dump(Auth::user()->username);

		return view('call.call');
	}


	public function postCall (CallPostRequest $request){
		if(!isset(Auth::user()->username)){
			return redirect('/')->withMessage(['type' => 'warning', 'content' => '请登陆']);
		}
/*
		$insertCall['toId']=$request->id;
		$insertCall['fromId']=Auth::user()->id;
		$insertCall['anonymous']=$request->anonymous?1:0;
		$insertCall['mainText']=$request->reason;
		

		
		DB::table('call')->insert($insertCall);
		return redirect()->back()->withMessage(['type' => 'success', 'content' => "揭发成功", 'isAnonymous' => $insertCall['anonymous']]);*/

		$call = new Call;

		$call->toId=$request->id;
		$call->fromId=Auth::user()->id;
		$call->anonymous=$request->anonymous?1:0;
		$call->mainText=$request->reason;
		//todo 这里验证学号和姓名是否匹配 API
		$call->save();

		return redirect('call/call')->withMessage(['type' => 'success', 'content' => "揭发成功" ])->withIsAnonymous($request->anonymous?1:0);
	}

	public function postLike(CallLikePostRequest $request){
		if(!isset(Auth::user()->username)){
			return redirect('/')->withMessage(['type' => 'warning', 'content' => '请登陆']);
		}
		//todo 在request中验证是否存在学号
		$addLike['studyId']=$request->id;
		$addLike['like']=+1;
		
	}

}

?>
