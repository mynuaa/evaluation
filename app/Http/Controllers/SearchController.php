<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Apply, App\Http\Requests\DetailsGetRequest, App\Pageview, App\Recommendation, App\Vote;
use Cache;

class SearchController extends Controller {

	public function index()
	{
		$applies = Apply::where('old', false)->order()->paginate(config('business.paginate'));

		return view('search.view')->withApplies($applies)->withStatistics($this->statistics());
	}

	public function getOld()
	{
		$applies = Apply::where('old', true)->order()->paginate(config('business.paginate'));

		return view('search.view')->withApplies($applies)->withStatistics($this->statistics());
	}

	public function getSchool()
	{
		$applies = Apply::type(config('business.type.school'))->order()->paginate(config('business.paginate'));

		return view('search.view')->withApplies($applies)->withStatistics($this->statistics());
	}

	public function getCollege($cid)
	{
		$applies = Apply::type(config('business.type.college'))->college($cid)->order()->paginate(config('business.paginate'));

		return view('search.view')->withApplies($applies)->withStatistics($this->statistics());
	}

	public function getDetails(DetailsGetRequest $request)
	{
		$type = $request->type;
		$key = $request->key;

		$applies = Apply::where($type, $key)->order()->paginate(config('business.paginate'));

		return view('search.view')->withApplies($applies)->withStatistics($this->statistics());
	}

	private function statistics()
	{
		return [
			'apply' => Apply::where('old', false)->count(),
			'recommendation' => Recommendation::count(),
			'vote' => Vote::count(),
			// 'visit' => Cache::get('visit', '10000+'),
		];
	}
}
