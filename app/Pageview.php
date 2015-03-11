<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;

class Pageview extends Model {

	use SoftDeletes;

	protected $fillable = ['ip', 'url', 'useragent', 'refer'];

	protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

	function scopeIp($query, $ip)
	{
		return $query->where('ip', '=', $ip);
	}
}
