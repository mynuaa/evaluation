<?php

return [
	'type' => [
		0 => 'school',
		1 => 'college',
		'school' => 0,
		'college' => 1
	],
	'paginate' => 30,
	'recommend' => [
		'max' => 5
	],
	'vote' => [
		'max' => 5
	],
	'avatar' => [
		'max' => 10
	],
	'deadline' => [
		'apply' => '',
		'vote' => ''
	],
	'MIME' => [
		'jpg' => 'image/jpeg',
		'jpeg' => 'image/jpeg',
		'bmp' => 'image/bmp',
		'png' => 'image/png',
	],
	'upload' => storage_path()."/app/photos/"
];