<?php namespace App\Http\Middleware;

use Closure, Auth;

class UserInfoUpdate {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (Auth::check() && ($request->path() != 'user/update'))
		{
			$user = Auth::user();
			if (($user->name == null) || $user->college == null)
			{
				return redirect('user/update')->withMessage(['type' => 'warning', 'content' => trans('message.user_info_needed')]);
			}
		}

		return $next($request);
	}

}
