<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{ asset('/css/rscss.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/font-awesome.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/main.css') }}">
	<title>@yield('title') - 纸飞机南航青年网络社区</title>
</head>
<body>
	<div class="rs-header">
		<div class="rs-container">
			<h1 class="fl">五四评优</h1>
			<nav id="nav-user" class="rs-nav fr">
				<ul class="rs-user-nav"></ul>
			</nav>
		</div>
	</div>
	@if (isset($message))
	<div class="rs-msg rs-msg-{{ $message['type'] }}">{{ $message['content'] }}</div>
	@endif
	<div class="rs-container">
		@yield('content')
	</div>
	<div class="rs-footer">
		<div class="rs-container">
			<div>Powered by 纸飞机南航青年网络社区</div>
			<div class="tip">请使用IE9以上的浏览器。</div>
		</div>
	</div>
</body>
</html>