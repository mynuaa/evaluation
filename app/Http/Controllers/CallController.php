<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth, App\User, App\Call;

use Input;
use Session;

use Illuminate\Http\Request, App\Http\Requests\CallPostRequest, App\Http\Requests\CallLikePostRequest;
use DB;

class CallController extends Controller {

	public function getMain(){
		//$allCall=DB::table('call')->lists('toId');
		//$heHas=Call::where('toId','=',1)->count();
		$allCall=Call::select('toId','name','studentid.college','studentid.likeAdd',DB::raw('COUNT(*) AS `cnt`'))->join('studentid','toId','=','studentid.studentid')->groupBy('toId')->having('cnt', '>' , 5)->orderBy('cnt','desc')->get();

		//调节少于多少不上墙
		
		$allId = [];
		foreach ($allCall as $key => $value) {
			$allId[]=$value['toId'];
		}
		$allId=implode(',', $allId);
		$allId='('.$allId.')';
		$content = Call::select("toId","mainText")->whereRaw("`toId` in {$allId}")->orderBy('id','desc')->get();
		$contentAll=[];

		foreach ($content as $value) {
			if (!isset($contentAll[$value['toId']])) {
				$contentAll[$value['toId']] = [$value['mainText']];
			} else if (count($contentAll[$value['toId']]) <= 20) { //这里Rex写挂过
				$contentAll[$value['toId']] []= $value['mainText'];
			}
		}

		foreach ($contentAll as &$value) {
			$value = implode(' | ', $value); 
		}

		return view('call.main')->withAllcall($allCall)->withAllcontent($contentAll);

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

		$callNum = DB::table('users')->select('callNum')->where('username',Auth::user()->username)->get();

		$callNum = $callNum[0]->callNum;
		if ($callNum == 0) {
			return redirect()->back()->withMessage(['type' => 'error', 'content' => '推荐次数已用尽!']);
		}

		$call = new Call;

		$call->toId=$request->id;
		$call->fromId=Auth::user()->id;
		$call->anonymous=$request->anonymous?1:0;
		$call->mainText=$request->reason;
		

		$dbre=DB::table('studentid')->select('name')->where('studentid',$call->toId)->get();

		if (!isset($dbre[0])) {
			return redirect()->back()->withMessage(['type' => 'error', 'content' => '数据错误！']);
		} else if ($dbre[0]->name != $request->name) {
			return redirect()->back()->withMessage(['type' => 'error', 'content' => '数据错误！']);
		}

		$call->save();

		DB::table('users')->where('username',Auth::user()->username)->update(['callNum' => $callNum-1]);
		
		return redirect('call/call')->withMessage(['type' => 'success', 'content' => "推荐成功" ])->withIsAnonymous($request->anonymous?1:0);
	}

	public function postLike(CallLikePostRequest $request){
		if(!isset(Auth::user()->username)){
			return redirect('/')->withMessage(['type' => 'warning', 'content' => '请登陆']);
		}

		$addLike['studyId']=$request->id;
		$dbre=DB::table('studentid')->select('likeAdd')->where('studentid',$request->id)->get();
		$addLike['like']=$dbre[0]->likeAdd;
		$addLike['like']+=1;
		DB::table('studentid')->where('studentid',$request->id)->update(['likeAdd'=>$addLike['like']]);
	}

	public function getStudentid(Request $request) {
		$name = $request->input('name');
		$studentinfos = DB::table('studentid')->select('studentid')->where('name',$name)->get();
		if(!isset($studentinfos[0])) {
			$return['code'] = -1;
			$return['message'] = 'failed';
			echo json_encode($return);
		}
		else {
			$return['code'] = 1;
			$return['message'] = 'success';
			$return['num'] = count($studentinfos);
			$return['data'] = $studentinfos;
			echo json_encode($return);
		}
	}

}
