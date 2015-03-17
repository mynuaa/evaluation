<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ApplyController extends Controller {

	public function getApply()
	{
		return view('apply.apply');
	}

	public function postApply()
	{
		var_dump($_POST);
	}

}
