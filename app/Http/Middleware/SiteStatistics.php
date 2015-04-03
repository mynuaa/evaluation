<?php namespace App\Http\Middleware;

use Closure, Auth, Request, Bus, Session;
use App\Commands\SaveStatistics;
use Illuminate\Foundation\Bus\DispatchesCommands as Dispatch;

use App;

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
		App::setLocale('en');
		$data = [
			'url' => $request->url(),
			'ip' => $request->server('REMOTE_ADDR'),
			'useragent' => $request->header('user-agent'),
			'refer' => $request->header('referer'),
			'uid' => Auth::check() ? Auth::user()->id : null
		];

		$response = $next($request);

		Bus::dispatch(
			new SaveStatistics($data)
		);

		return $response;
	}

}
