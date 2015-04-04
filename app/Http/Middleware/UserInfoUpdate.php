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
		if (Auth::check())
		{
			$path = $request->path();
			$whitelist = ['user/update', 'user/logout', '/'];
			
			if ( ! in_array($path, $whitelist) )
			{
				$user = Auth::user();
				if (($user->name == null) || $user->college == null)
				{
					return redirect('user/update')->withMessage(['type' => 'warning', 'content' => trans('message.user.info_need')]);
				}
			}
		}

		return $next($request);
	}

}
