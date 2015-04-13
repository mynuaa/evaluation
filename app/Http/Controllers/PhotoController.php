<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Storage;

class PhotoController extends Controller {

	public function photo($name)
	{
		$filename = '/photos/' . $name;

		if(Storage::exists($filename))
		{
			$photo = Storage::get($filename);
			return response($photo, 200)->header('Content-Type', config('business.MIME.' . strtolower(preg_replace('/^\w+\./', '', $name))));

		}
		else
		{
			abort(404, trans('resource_not_found'));
		}
	}

	public function thumb($name)
	{
		$filename = '/thumbs/' . $name;

		if(Storage::exists($filename))
		{
			$photo = Storage::get($filename);
			return response($photo, 200)->header('Content-Type', config('business.MIME.' . strtolower(preg_replace('/^\w+\./', '', $name))));

		}
		else
		{
			abort(404, trans('resource_not_found'));
		}
	}
}
