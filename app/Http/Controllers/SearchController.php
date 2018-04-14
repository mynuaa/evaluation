<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Apply, App\Http\Requests\DetailsGetRequest, App\Pageview, App\Recommendation, App\Vote;
use Cache;

class SearchController extends Controller {

	public function index() {
		if(isset($_GET['page']) && intval($_GET['page']) > 0){//非首页（置page）则倒序输出
			$applies = Apply::where('year', D_YEAR)->orderBy('id', 'desc')->paginate(config('business.paginate'));
		}else{//之前的
			$applies = Apply::where('year', D_YEAR)->orderByRaw("RAND()")->paginate(config('business.paginate'));
		}

		return view('search.view')->withApplies($applies)->withStatistics($this->statistics());
	}

	public function getOld() {
		$applies = Apply::where('year', '<', D_YEAR)->orderByRaw("RAND()")->paginate(config('business.paginate'));

		return view('search.view')->withApplies($applies)->withStatistics($this->statistics());
	}

	public function getSchool() {
		$applies = Apply::type(config('business.type.school'))->where('year', D_YEAR)->orderByRaw("RAND()")->paginate(config('business.paginate'));

		return view('search.view')->withApplies($applies)->withStatistics($this->statistics());
	}

	public function getCollege($cid) {
		//$applies = Apply::type(config('business.type.college'))->where('year', D_YEAR)->college($cid)->orderByRaw("RAND()")->paginate(config('business.paginate'));
		$applies = Apply::where('year', D_YEAR)->college($cid)->orderBy('id', 'desc')->paginate(config('business.paginate'));
		return view('search.view')->withApplies($applies)->withStatistics($this->statistics());
	}

	public function getDetails(DetailsGetRequest $request) {
		$type = $request->type;
		$key = $request->key;

		$applies = Apply::where('year', D_YEAR)->where($type, $key)->orderByRaw("RAND()")->paginate(config('business.paginate'));

		return view('search.view')->withApplies($applies)->withStatistics($this->statistics());
	}

	private function statistics() {
		return [
			'apply' => Apply::where('year', D_YEAR)->count(),
			'recommendation' => Recommendation::count(),
			'vote' => Vote::count(),
			// 'visit' => Cache::get('visit', '10000+'),
		];
	}
}
