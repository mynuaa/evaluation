<?php namespace App\Http\Middleware;

use Closure, Session, App;

class LocalLanguage {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ( $request->has('lang') && in_array($request->lang, config('business.languages')))
		{
			Session::put('language', $request->lang);
		}
		else if ( ! Session::has('language') )
		{
			Session::put('language', config('business.languages.default'));
		}

		App::setLocale(Session::get('language'));

		return $next($request);
	}

}
