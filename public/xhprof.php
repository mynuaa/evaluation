<?php

	xhprof_enable(XHPROF_FLAGS_CPU+XHPROF_FLAGS_MEMORY);

	echo 1;

	$data = xhprof_disable();

	$xhprof_root = "/usr/share/xhprof";

	include_once $xhprof_root."/xhprof_lib/utils/xhprof_lib.php";
	include_once $xhprof_root."/xhprof_lib/utils/xhprof_runs.php";

	$xhprof_runs = new XHprofRuns_Default();
	$run_id = $xhprof_runs->save_run($data, "test");

	var_dump($data);
?>