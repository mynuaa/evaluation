<?php

return [
	'type' => [
		0 => 'school',
		1 => 'college',
		'school' => 0,
		'college' => 1
	],
	'paginate' => 15,
	'recommend' => [
		'max' => 5
	],
	'vote' => [
		'max' => 6,
		'inner' => 4,
		'outer' => 2
	],
	'avatar' => [
		'max' => 13
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
