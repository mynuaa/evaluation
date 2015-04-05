<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pageview extends Model {

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

	public function scopeToday($query)
	{
		return $query->where('created_at', '>', date('Y-m-d'));
	}
}
