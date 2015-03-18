<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;

class Pageview extends Model {

	use SoftDeletes;

	protected $fillable = ['ip', 'uid', 'url', 'useragent', 'refer'];

	protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

	public function setIpAttribute($value)
	{
		$this->attributes['ip'] = ip2long($value);
	}

	public function getIpAttribute($value)
	{
		return long2ip($value);
	}
	// function scopeIp($query, $ip)
	// {
	// 	return $query->where('ip', '=', $ip);
	// }
}
