<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

	public function apply(){
		return $this->belongsTo('App\Apply');
	}

}
