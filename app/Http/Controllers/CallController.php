<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth, App\User, App\Call;

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

		//$db=DB:table('call')->list('id');
		//var_dump(Auth::user()->id);
		return view('call.call')->withDebug('0');
	}


	public function postCall (CallPostRequest $request){
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

}

?>
