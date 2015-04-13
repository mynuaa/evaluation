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
		'max' => 8,
		'college' => 4,
		'school' => 4,
		'inner' => 4,
		'outer' => 4
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
	'photo' => "photos/",
	'WeChat_UA' => 'MicroMessenger',
	'tag' => [
		'max' => 5
	],
	'languages' => [
		'default' => 'zh',
		'en'
	]
];