<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;

class Recommendation extends Model {

	use SoftDeletes;

	protected $fillable = ['user_id', 'apply_id', 'content'];

	protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function apply()
	{
		return $this->belongsTo('Apply');
	}
}
