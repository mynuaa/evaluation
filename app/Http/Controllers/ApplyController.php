<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth, App\User, App\Apply, App\Http\Requests\ApplyPostRequest, App\Http\Requests\MasterapplyRequest;

use Input, App\Recommendation, App\Http\Requests\RecommendPostRequest;
use Session;

use App\Http\Requests\GetNameRequest;

use Intervention\Image\Facades\Image;

use Maatwebsite\Excel\Facades\Excel;
use DB;

class ApplyController extends Controller {

	private $backdoor = ['051230303', 'SX1411003', '0316302260', '161510126', '041400807'];

	public function __construct() {
		$this->middleware('auth', ['only' => ['getApply', 'postApply', 'postRecommendation', 'getVote', 'getDelete']]);
	}

	public function getApply() {
		// if (!in_array(Auth::user()->username, $this->backdoor)) {
		// 	return redirect()->back()->withApply(Auth::user()->apply)->withMessage(['type' => 'warning', 'content' => '申报结束。']);
		// }

		$apply = Auth::user()->apply;
		return view('apply.apply')->withApply($apply)->withStuid(Auth::user()->username);
	}

	public function getMasterapply() {
		if(!isset(Auth::user()->username)){
			return redirect()->back()->withMessage(['type' => 'warning', 'content' => '请登陆']);
		}

		if (!in_array(Auth::user()->username, $this->backdoor)) {
			return redirect()->back()->withApply(Auth::user()->apply)->withMessage(['type' => 'warning', 'content' => '本次评选不允许支部推荐。']);
		}

		$apply = Auth::user()->apply;
		$userid = Auth::user()->username;
		$classes = DB::table('studentid')->select('class')->where('studentid',$userid)->get();
		if($classes) {
			$class = $classes[0]->class;
		}
		else {
			$class = "未知班级";
		}
		$students = $classes = DB::table('masterapplys')->select('studentid','name')->where('class',$class)->get();
		return view('apply.masterapply')->withApply($apply)->withStuid(Auth::user()->username)->withClass($class)->withStudents($students);
	}

	public function postMasterapply(MasterapplyRequest $request) {
		if(!isset(Auth::user()->username)){
			return redirect()->back()->withMessage(['type' => 'warning', 'content' => '请登陆']);
		}
		$addStudent = [];
		if($request->name1 != '' && $request->id1 != '') {
			$classes = DB::table('studentid')->select('class','name')->where('studentid',$request->id1)->get();
			$ifAdd = DB::table('masterapplys')->select('class')->where('studentid',$request->id1)->get();
			if($ifAdd) {
				return redirect('apply/apply')->withMessage(['type' => 'error', 'content' => '信息错误']);
			}
			else if($classes) {
				if($classes[0]->class != $request->class) {
					return redirect('apply/masterapply')->withMessage(['type' => 'error', 'content' => '该同学不在你的班级']);
				}
				else if($classes[0]->name != $request->name1) {
					return redirect('apply/masterapply')->withMessage(['type' => 'error', 'content' => '信息错误']);
				}
				else {
					$add['studentid'] = $request->id1;
					$add['class'] = $request->class;
					$add['name'] = $request->name1;
					DB::table('masterapplys')->insert($add);
				}
			}
			else {
				return redirect('apply/masterapply')->withMessage(['type' => 'error', 'content' => '信息错误']);
			}
		}
		if($request->name2 != '' && $request->id2 != '') {
			$classes = DB::table('studentid')->select('class','name')->where('studentid',$request->id2)->get();
			$ifAdd = DB::table('masterapplys')->select('class')->where('studentid',$request->id2)->get();
			if($ifAdd) {
			}
			else if($classes) {
				if($classes[0]->class != $request->class) {
					return redirect('apply/masterapply')->withMessage(['type' => 'error', 'content' => '该同学不在你的班级']);
				}
				else if($classes[0]->name != $request->name2){
					return redirect('apply/masterapply')->withMessage(['type' => 'error', 'content' => '信息错误']);
				}
				else {
					$add['studentid'] = $request->id2;
					$add['class'] = $request->class;
					$add['name'] = $request->name2;
					DB::table('masterapplys')->insert($add);
				}
			}
			else {
				return redirect('apply/masterapply')->withMessage(['type' => 'error', 'content' => '信息错误']);
			}
		}
		if($request->name3 != '' && $request->id3 != '') {
			$classes = DB::table('studentid')->select('class','name')->where('studentid',$request->id3)->get();
			$ifAdd = DB::table('masterapplys')->select('class')->where('studentid',$request->id3)->get();
			if($ifAdd) {
			}
			else if($classes) {
				if($classes[0]->class != $request->class) {
					return redirect('apply/masterapply')->withMessage(['type' => 'error', 'content' => '该同学不在你的班级']);
				}
				else if($classes[0]->name != $request->name3){
					return redirect('apply/masterapply')->withMessage(['type' => 'error', 'content' => '信息错误']);
				}
				else {
					$add['studentid'] = $request->id3;
					$add['class'] = $request->class;
					$add['name'] = $request->name3;
					DB::table('masterapplys')->insert($add);
				}
			}
			else {
				return redirect('apply/masterapply')->withMessage(['type' => 'error', 'content' => '信息错误']);
			}
		}
		return redirect('apply/masterapply')->withMessage(['type' => 'success', 'content' => '推荐成功']);
	}

	public function postApply(ApplyPostRequest $request) {
		if(!isset(Auth::user()->username)){
			return redirect()->back()->withMessage(['type' => 'warning', 'content' => '请登陆']);
		}

		//TODO:这个后门！！！注意！！！控制关闭！！
		if (!in_array(Auth::user()->username, $this->backdoor)) {
			return redirect()->back()->withApply(Auth::user()->apply)->withMessage(['type' => 'warning', 'content' => '申报已经结束。']);
		}

		$request->photos = [];
		foreach ($request->file('imgs') as $key => $file) {
			if ($file) {
				if (!$file->isValid()) {
					return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.file.fail')]);
				}
				if (in_array($file->getClientMimeType(), config('business.MIME'))) {
					$filename = md5($file->getClientOriginalName().$file->getClientSize()).'.'.$file->getClientOriginalExtension();
					$file->move(storage_path() . '/app/photos', $filename);
					$img = Image::make(storage_path() . '/app/photos/' . $filename)->resize(null, 150, function ($constraint) { $constraint->aspectRatio(); });
					$img->save(storage_path() . '/app/thumbs/' . $filename, 75);
					$request->photos[$key] = $filename;
				}
				else{
					abort(500, trans('message.file.wrong_type'));
				}
			}
		}

		$user = Auth::user();

		$apply = Apply::firstOrNew(['user_id' => $user->id, 'year' => D_YEAR]);

		$apply->type = $request->type;
		$apply->stuid = $user->username;
		$apply->name = Auth::user()->name;
		$apply->college = Auth::user()->college;
		$apply->sex = $request->sex;
		$apply->native_place = $request->native_place;
		$apply->political = $request->political;
		$apply->major = $request->major;
		$apply->title = $request->title;
		$apply->whoami = $request->whoami;
		$apply->story = $request->story;
		$apply->insufficient = $request->insufficient;
		$apply->tag1 = isset($request->tags[0]) ? $request->tags[0] : '';
		$apply->tag2 = isset($request->tags[1]) ? $request->tags[1] : '';
		$apply->tag3 = isset($request->tags[2]) ? $request->tags[2] : '';

		foreach ($request->photos as $key => $photo) {
			$keyname = 'img'.($key+1);
			$apply->$keyname = $photo;
		}

		$apply->intro1 = isset($request->intros[0]) ? $request->intros[0] : '';
		$apply->intro2 = isset($request->intros[1]) ? $request->intros[1] : '';
		$apply->intro3 = isset($request->intros[2]) ? $request->intros[2] : '';

		$apply->video_url = $request->video_url;

		$user->apply()->save($apply);

		return redirect('apply/apply')->withMessage(['type' => 'success', 'content' => trans('message.apply.success')]);
	}

	public function getShow($id, Request $request) {

		$apply = Apply::find($id);

		if ($apply) {

			$apply->increment('pageview');
			$apply->isRecommended = Auth::check() ? Auth::user()->isRecommended($id) : true;
			$apply->isVoted = Auth::check() ? Auth::user()->isVoted($id) : true;
			$isStop;
			if($apply->year == 2016 && !in_array($apply->user->username, $this->backdoor)) {
				$isStop = 1;
			}
			else {
				$isStop = 0;
			}

			$canvote = 0;

			$masterapply = DB::table('masterapplys')->select('class')->where('studentid',$apply->stuid)->get();
			if($masterapply) {
				$masterapply = 1;
			}
			else {
				$masterapply = 0;
			}

			if($masterapply || $apply->recommendations >= 10) {
				$canvote = 1;
			}

			return view('apply.show')->withApply($apply)->withIsWechat(
				strstr($request->header('user-agent'), config('business.WeChat_UA')) != false
 			)->withIsStop($isStop)->withCanVote($canvote);
		}
		else{
			abort(404, 'Application not found.');
		}
	}

	public function postRecommendation(RecommendPostRequest $request) {
		//TODO: 关闭开关
		if (!in_array(Apply::find($request->applyid)->user->username, $this->backdoor))
			return redirect()->back()->withMessage(['type' => 'warning', 'content' => '推荐已经截止了']);

		if(!isset(Auth::user()->username)){
			return redirect()->back()->withMessage(['type' => 'warning', 'content' => '登入失效']);
		}
		$user = Auth::user();

		if ($user->isRecommendTooMuch()) {
			return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.recommend.too_much')]);
		}

		if ($user->isRecommended($request->applyid)) {
			return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.recommend.before')]);
		}

		$user->recommendations()->attach($request->applyid, ['content' => $request->content]);
		Apply::find($request->applyid)->increment('recommendations');

		$remain = $user->remain();

		return redirect()->back()->withMessage(['type' => 'success', 'content' => trans('message.recommend.success')]);
	}


	private function checkLimit($voteInner, $voteOuter) {
		// $limit = [
		// 	0 => [0, 7],
		// 	1 => [1, 7],
		// 	2 => [1, 6],
		// 	3 => [2, 5],
		// 	4 => [3, 4],
		// 	5 => [3, 3],
		// ];
		$limit = [
			0 => [0, 5],
			1 => [0, 5],
			2 => [1, 4],
			3 => [2, 3],
			4 => [2, 2]
		];
		return isset($limit[$voteInner]) && $voteOuter >= $limit[$voteInner][0] && $voteOuter <= $limit[$voteInner][1];
	}

	public function getVote($id) {
		$beginDay = date("d");
		if($beginDay < 16) {
			return redirect()->back()->withMessage(['type' => 'warning', 'content' => '投票还没开始！']);
		} else if($beginDay > 20) {
			return redirect()->back()->withMessage(['type' => 'warning', 'content' => '投票结束！']);
		}

		if (Auth::user()->isVoted($id)) {
			return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.vote.before')]);
		}

		$apply = Apply::find($id);
		$user = Auth::user();

		//院级评选只能本院投票
		if ($apply->type == config('business.type.college')) {
			if ($apply->college != $user->college) {
				return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.vote.cross_college')]);
			}
		}

		// 最大票数限制
		if ($user->votes()->count() >= config('business.vote.max')) {
			return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.vote.too_much')]);
		}

		//同学院 || 不同学院
		if ($user->college == $apply->college) {
			// if ($user->countInner() >= config('business.vote.inner')) {
			if (!$this->checkLimit($user->countInner() + 1, $user->countOuter())) {
				return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.vote.out_of_range', ['voteInner' => $user->countInner() + 1, 'voteOuter' => $user->countOuter()])]);
			}
		}
		else{
			// if ($user->countOuter() >= config('business.vote.outer')) {
			if (!$this->checkLimit($user->countInner(), $user->countOuter() + 1)) {
				return redirect()->back()->withMessage(['type' => 'error', 'content' => trans('message.vote.out_of_range', ['voteInner' => $user->countInner(), 'voteOuter' => $user->countOuter() + 1])]);
			}
		}

		$user->votes()->attach($id);
		$apply->increment('votes');

		$remain = Auth::user()->remain();

		return redirect()->back()->withMessage([
			'type' => 'success',
			'content' => trans('message.vote.success', ['voteInner' => $user->countInner(), 'voteOuter' => $user->countOuter()])
		]);
	}

	public function getLike($id) {
		Apply::find($id)->increment('like');
	}

	public function getDelete($id) {
		if (Auth::user()->isAdmin()) {
			Apply::find($id)->delete();

			return redirect('/')->withMessage(['type' => 'success', 'content' => '删除成功 =。=']);
		}
		else
		{
			abort(403, 'Access denied.');
		}
	}

	private function excel_translate($str) {
		if (strpos($str, '=') === 0) {
			return "'" . $str;
		}
		return $str;
	}

	public function getAll(Request $request) {
		if ($request->college)
			$result = Apply::where('college', $request->college)->where('year', D_YEAR)->where('recommendations', '>', 9)->orderBy('stuid')->paginate(23333);
		else
			$result = Apply::where('year', D_YEAR )->where('recommendations', '>', 9)->orderBy('stuid')->paginate(23333);
		$data = [];
		foreach ($result as $apply) {
			$data []= [
				'姓名' => $this->excel_translate($apply->name),
				'学号' => $this->excel_translate($apply->stuid),
				'学院' => $this->excel_translate($apply->user->college),
				'籍贯' => $this->excel_translate($apply->native_place),
				'政治面貌' => $this->excel_translate($apply->political),
				'专业' => $this->excel_translate($apply->major),
				'事迹' => $this->excel_translate(preg_replace('/[\ \t\n]+/', ' ', html_entity_decode(strip_tags($apply->story))))
			];
		}
		Excel::create($request->college ? $request->college : '汇总', function($excel) use($data) {
			$excel->sheet('申报数据', function($sheet) use($data) {
				$sheet->fromArray($data);
			});
		})->export('xls');
		return 'ok';
	}

	public function getVotelike(Request $request) {
		if(!isset(Auth::user()->username)){
			return redirect()->back()->withMessage(['type' => 'warning', 'content' => '请登陆']);
		}

		if ($request->college)
			$result = Apply::where('type', 1)->where('year', D_YEAR)->where('recommendations', '>', 9)->orderBy('stuid')->paginate(23333);
		else
			$result = Apply::where('type', 0)->where('year', D_YEAR)->where('recommendations', '>', 9)->orderBy('stuid')->paginate(23333);
		$data = [];
		foreach ($result as $apply) {
			$data []= [
				'姓名' => $this->excel_translate($apply->name),
				'学号' => $this->excel_translate($apply->stuid),
				'学院' => $this->excel_translate($apply->user->college),
				'投票数' => $this->excel_translate($apply->votes),
				'点赞数' => $this->excel_translate($apply->like),
			];
		}
		Excel::create($request->college ? '院级' : '校级', function($excel) use($data) {
			$excel->sheet('统计数据', function($sheet) use($data) {
				$sheet->fromArray($data);
			});
		})->export('xls');
		return 'ok';
	}
}
