<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use App\Services\HtmlAttributeFilter;
use App;

class Call extends Model {

	use SoftDeletes;
	protected $table = 'call';
	
	/*
	public function callnum(){

		return $this->hasMany('App\Call','toId');

	}*/
}
