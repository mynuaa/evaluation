<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
	<link rel="stylesheet" href="{{ asset('/css/rscss.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/font-awesome.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/main.css') }}">
	<title>@yield('title') - 纸飞机南航青年网络社区</title>
</head>
<body>
	<!-- 页眉 -->
	<div class="rs-header">
		<div class="rs-container">
			<a href="{{ url('/') }}"><h1 class="fl pointer white">五四评优</h1></a>
			<nav id="nav-main" class="rs-nav fl">
				<ul class="rs-main-nav">
					<a href="{{ url('apply/apply') }}"><li name="common/message">我要申报</li></a>
				</ul>
			</nav>
			<nav id="nav-user" class="rs-nav fr">
				<ul class="rs-user-nav">
					@if (Auth::check())
					<a href="{{ url('user/logout') }}"><li>注销</li></a>
					@else
					<a href="{{ url('user/login') }}"><li>登录</li></a>
					@endif
				</ul>
			</nav>
		</div>
	</div>
	<!-- 消息显示块 -->
	@if (Session::has('message'))
	<div class="rs-message">
		<div class="rs-container">
			<div class="rs-msg rs-msg-{{ session('message')['type'] }}">
				{{ session('message')['content'] }}
			</div>
		</div>
	</div>
	@endif
	<!-- 主体内容 -->
	<div class="rs-container">
		@yield('content')
	</div>
	<!-- 页脚 -->
	<div class="rs-footer center">
		<div class="rs-container">
			<div>©纸飞机南航青年网络社区 2015</div>
		</div>
	</div>
	<script>
		@yield('scripts')
	</script>
</body>
</html>