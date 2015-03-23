<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;

class Apply extends Model {

	use SoftDeletes;

	protected $guarded = ['id', 'deleted_at', 'created_at', 'updated_at'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function scopeType($query, $type)
	{
		return $query->whereType($type);
	}

	// public function recommendateds()
	// {
	// 	return $this->belongsToMany('User', 'votes');$_POST['variable']
	// }
}
