<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Storage;

class PhotoController extends Controller {

	public function show($name)
	{
		if(Storage::exists(config('business.photo') . $name))
		{
			$photo = Storage::get(config('business.photo') . $name);
			return response($photo, 200)->header('Content-Type', config('business.MIME.' . preg_replace('/^\w+\./', '', $name)));

		}
		else
		{
			abort(404, trans('resource_not_found'));
		}
	}
}
