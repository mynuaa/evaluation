<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;

use DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, SoftDeletes;

	protected $table = 'users';

	protected $fillable = ['username', 'password', 'college', 'name', 'avatar'];

	protected $hidden = ['password', 'remember_token'];

	public function apply() {
		return $this->hasOne('App\Apply')->where('applies.year', D_YEAR);
	}

	public function recommendations() {
		return $this->belongsToMany('App\Apply', 'recommendations')->where('year',D_YEAR)->whereNull('recommendations.deleted_at');
	}

	public function votes() {

		return $this->belongsToMany('App\Apply', 'votes')->where('year',D_YEAR)->whereNull('votes.deleted_at')->withTimestamps();
		/*触发webhook*/
	}

	public function myRecommendations() {
		return $this->hasMany('App\Recommendation')->join('applies', 'recommendations.apply_id', '=', 'applies.id')->select('apply_id','recommendations.id','content','title')->where('year',D_YEAR);
	}

	public function isRecommended($applyid) {
		return $this->recommendations()->where('apply_id', $applyid)->exists();
	}

	public function isRecommendTooMuch() {
		return $this->recommendations()->count() >= config('business.recommend.max');
	}

	public function isVoted($applyid) {
		return $this->votes()->where('apply_id', $applyid)->exists();
	}

	public function voteDetail() {
		return [
			'vote' => $this->votes()->count(),
			'inner' => $this->countInner(),
			'outer' => $this->countOuter(),
		];
	}

	public function remain() {
		return [
			'vote' => config('business.vote.max') - $this->votes()->count(),
			'inner' => config('business.vote.inner') - $this->countInner(),
			'outer' => config('business.vote.outer') - $this->countOuter(),
			// 'recommend' => config('business.recommend.max') - $this->recommendations()->count()
		];
	}

	public function isAdmin() {
		return $this->admin == 1;
	}

	public function voteTypeCount($type) {
		return $this->votes()->where('votes.type', $type)->where('year',D_YEAR)->count();
	}

	public function countInner() {
		return $this->votes()->where('college', $this->college)->where('year',D_YEAR)->count();
	}

	public function countOuter() {
		return $this->votes()->where('college', '!=', $this->college)->where('year',D_YEAR)->count();
	}
}
