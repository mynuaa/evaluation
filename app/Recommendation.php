<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;

class Recommendation extends Model {

	use SoftDeletes;

	protected $fillable = ['user_id', 'apply_id', 'content'];

	protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

	// public function scopeUser($query, $userid)
	// {
	// 	return $query->whereUserId($userid);
	// }

	public function scopeApply($query, $applyid) {
		return $query->whereApplyId($applyid)->->join('applies', 'applies.id', '=', $applyid);
	}
	public function user() {
		return $this->belongsTo('App\User');
	}

	public function apply() {
		return $this->belongsTo('App\Apply');
	}

	// public function apply()
	// {
	// 	return $this->belongsTo('Apply');
	// }
}
