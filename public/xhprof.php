<?php

	xhprof_enable();

	echo 1;

	$data = xhprof_disable();

	var_dump($data);
?>