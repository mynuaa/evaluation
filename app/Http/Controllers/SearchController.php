<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Apply, App\Http\Requests\DetailsGetRequest;

class SearchController extends Controller {

	public function getSchool()
	{
		$applies = Apply::type(config('business.type.school'))->get();

		return view('search.view')->withApplies($applies);
	}

	public function getCollege($cid)
	{
		$applies = Apply::type(config('business.type.college'))->college($cid)->get();

		return view('search.view')->withApplies($applies);
	}

	public function getDetails(DetailsGetRequest $request)
	{
		$type = $request->type;
		$key = $request->key;

		$applies = Apply::where($type, $key)->get();

		return view('search.view')->withApplies($applies);
	}
}
