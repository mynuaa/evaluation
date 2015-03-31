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
			return Storage::get(config('business.photo') . $name);
		}
		else
		{
			abort(404, trans('resource_not_found'));
		}
	}
}
