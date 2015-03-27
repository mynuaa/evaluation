<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, SoftDeletes;

	protected $table = 'users';

	protected $fillable = ['username', 'password', 'college', 'name', 'avatar'];

	protected $hidden = ['password', 'remember_token'];

	public function apply()
	{
		return $this->hasOne('App\Apply');
	}

	public function recommendations()
	{
		return $this->belongsToMany('App\Apply', 'recommendations');
	}

	public function votes()
	{
		return $this->belongsToMany('App\Apply', 'votes');
	}

	public function myRecommendations()
	{
		return $this->hasMany('App\recommendation');
	}

	public function isRecommended($applyid)
	{
		return $this->recommendations()->where('apply_id', $applyid)->exists();
	}

	public function isRecommendTooMuch()
	{
		return $this->recommendations()->count() >= config('business.recommend.max');
	}

	public function isVoted($applyid)
	{
		return $this->votes()->where('apply_id', $applyid)->exists();
	}
	// public function scopeStuid($query, $stuid)
	// {
	// 	return $query->whereUsername($stuid);
	// }

	// public function isAdmin()
	// {
	// 	return $this->admin == 1;
	// }

	// public function scopeAdmin($query)
	// {
	// 	return $query->where('admin', '=', 1);
	// }
}
