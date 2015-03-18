<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;

class Apply extends Model {

	use SoftDeletes;

	protected $fillable = ['user_id', 'type', 'opition', 'whoami', 'story'];

	protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	// public function recommendateds()
	// {
	// 	return $this->belongsToMany('User', 'votes');
	// }
}
