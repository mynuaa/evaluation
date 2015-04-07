<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Apply, App\Http\Requests\DetailsGetRequest, App\Pageview, App\Recommendation;
use Cache;

class SearchController extends Controller {

	public function index()
	{
		$applies = Apply::order()->paginate(config('business.paginate'));

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
			'apply' => Apply::all()->count(),
			'recommendation' => Recommendation::all()->count(),
			'visit' => Cache::get('visit', '10000+'),
		];
	}
}
