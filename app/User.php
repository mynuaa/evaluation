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

	public function scopeStuid($query, $stuid)
	{
		return $query->whereUsername($stuid);
	}

	// public function isAdmin()
	// {
	// 	return $this->admin == 1;
	// }

	// public function scopeAdmin($query)
	// {
	// 	return $query->where('admin', '=', 1);
	// }
}
