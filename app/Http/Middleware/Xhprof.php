<?php namespace App\Http\Middleware;

use Closure, Auth;

class xhprof {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// if (Auth::user()->isAdmin()){
		// 	echo "<!--Xhprof Begin-->";
		// 	//xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
		// 	xhprof_enable();
		// }
		
		return $next($request);

		// if (Auth::user()->isAdmin()){
		// 	$data = xhprof_disable();
		// 	var_dump($data);

			// $xhprof_root = "/usr/share/xhprof";

			// include_once $xhprof_root."/xhprof_lib/utils/xhprof_lib.php";
			// include_once $xhprof_root."/xhprof_lib/utils/xhprof_runs.php";

			// $xhprof_runs = new XHprofRuns_Default();
			// $run_id = $xhprof_runs->save_run($data, "test");
		// }
	}

}
