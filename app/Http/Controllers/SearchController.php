<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Apply, App\Http\Requests\DetailsGetRequest;

class SearchController extends Controller {

	public function index()
	{
		$applies = Apply::paginate(config('business.paginate'));

		return view('search.view')->withApplies($applies);
	}

	public function getSchool()
	{
		$applies = Apply::type(config('business.type.school'))->paginate(config('business.paginate'))->get();

		return view('search.view')->withApplies($applies);
	}

	public function getCollege($cid)
	{
		$applies = Apply::type(config('business.type.college'))->college($cid)->paginate(config('business.paginate'))->get();

		return view('search.view')->withApplies($applies);
	}

	public function getDetails(DetailsGetRequest $request)
	{
		$type = $request->type;
		$key = $request->key;

		$applies = Apply::where($type, $key)->paginate(config('business.paginate'))->get();

		return view('search.view')->withApplies($applies);
	}
}
