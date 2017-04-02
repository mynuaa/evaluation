<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Admin;

use APP\Recommendation;
use App\Services\DedVerify;
use App\Services\GsmVerify;
use App\Services\HrVerify;
use App\Http\Requests\LoginPostRequest;
use DB;

use Validator, Auth, App\User, Input;

use App\Http\Requests\UpdatePostRequest;

class AdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	}
	public function getShowrecommendation()
	{
		$records = DB::table('recommendations')
		->join('applies', 'applies.id', '=', 'apply_id')->select('apply_id',DB::raw('COUNT(apply_id) as num'),'applies.name')->where('year',2017)->groupBy('apply_id')->get();
		return view('admin/showrecommendation')->withRecords($records);
	}
	public function getShowonerecommendations($apply_id=1)
	{
		$records = DB::table('recommendations')->join('applies', 'applies.id', '=', 'apply_id')->where('apply_id',$apply_id)->get();
		$Owner = DB::table('users')->select('name')->where('id',$apply_id)->get();
		return view('admin/showonerecommendations')->withRecords($records)->withOwner($Owner[0]);
	}

}
