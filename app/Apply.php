<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use App\Services\HtmlAttributeFilter;

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

	public function scopeCollege($query, $collegeid)
	{
		return $query->whereCollege($collegeid);
	}

	// public function recommendations()
	// {
	// 	return $this->belongsToMany('App\User', 'recommendations');
	// }

	public function recommendations()
	{
		return $this->hasMany('App\Recommendation');
	}

	public function scopeOrder($query)
	{
		return $query->orderBy('votes', 'desc');
		// return $query->orderByRaw('rand()');
	}

	public function getVideoUrlAttribute($value) {
		return $value ? explode("\n", $value) : [];
	}

	public function getWhoamiAttribute($value, HtmlAttributeFilter $filter) {
		return $value ? strip_tags($filter->strip($value), '<strong><em><p><span><img>') : "u";
	}

	public function getStoryAttribute($value, HtmlAttributeFilter $filter) {
		return $value ? strip_tags($filter->strip($value), '<strong><em><p><span><img>') : "u";
	}

	public function getInsufficientAttribute($value, HtmlAttributeFilter $filter) {
		return $value ? strip_tags($filter->strip($value), '<strong><em><p><span><img>') : "u";
	}
}
