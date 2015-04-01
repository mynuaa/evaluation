<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Apply, App\Http\Requests\DetailsGetRequest;

class SearchController extends Controller {

	public function index()
	{
		$applies_origin = Apply::paginate(config('business.paginate'));

		$applies = array_sort($applies_origin->items(), function($value){
			return rand();
		});

		return view('search.view')->withAppliesOrigin($applies_origin)->withApplies($applies);
	}

	public function getSchool()
	{
		$applies_origin = Apply::type(config('business.type.school'))->paginate(config('business.paginate'));

		$applies = array_sort($applies_origin->items(), function($value){
			return rand();
		});

		return view('search.view')->withAppliesOrigin($applies_origin)->withApplies($applies);
	}

	public function getCollege($cid)
	{
		$applies_origin = Apply::type(config('business.type.college'))->college($cid)->paginate(config('business.paginate'));

		$applies = array_sort($applies_origin->items(), function($value){
			return rand();
		});

		return view('search.view')->withAppliesOrigin($applies_origin)->withApplies($applies);
	}

	public function getDetails(DetailsGetRequest $request)
	{
		$type = $request->type;
		$key = $request->key;

		$applies_origin = Apply::where($type, $key)->paginate(config('business.paginate'));

		$applies = array_sort($applies_origin->items(), function($value){
			return rand();
		});

		return view('search.view')->withAppliesOrigin($applies_origin)->withApplies($applies);
	}
}
