<?php namespace App\Http\Middleware;

use Closure, Auth, Request, Bus, Session;
use App\Commands\SaveStatistics;
use Illuminate\Foundation\Bus\DispatchesCommands as Dispatch;

class SiteStatistics {

	use Dispatch;
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		var_dump(Session::all());
		$data = [
			'url' => $request->url(),
			'ip' => ip2long($request->server('REMOTE_ADDR')),
			'useragent' => $request->server('HTTP_USER_AGENT'),
			'refer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null,
			'uid' => Auth::check() ? Auth::user()->id : null
		];

		$response = $next($request);

		Bus::dispatch(
			new SaveStatistics($data)
		);

		return $response;
	}

}
