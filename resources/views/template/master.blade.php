<!--
                    _ooOoo_
                   o8888888o
                   88" . "88
                   (| -_- |)
                   O\  =  /O
                ____/`---'\____
              .'  \\|     |//  `.
             /  \\|||  :  |||//  \
            /  _||||| -:- |||||-  \
            |   | \\\  -  /// |   |
            | \_|  ''\---/''  |   |
            \  .-\__  `-`  ___/-. /
          ___`. .'  /--.--\  `. . __
       ."" '<  `.___\_<|>_/___.'  >'"".
      | | :  `- \`.;`\ _ /`;.`/ - ` : | |
      \  \ `-.   \_ __\ /__ _/   .-` /  /
 ======`-.____`-.___\_____/___.-`____.-'======
                    `=---='
 ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
            佛祖保佑       永无BUG
-->
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
	<link rel="stylesheet" href="{{ asset('/css/rscss.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/font-awesome.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/main.css') }}">
	<title>@yield('title') - 南航校团委五四评优</title>
	<!--[if lt IE 9]>
	<script src="{{ asset('/js/html5.js') }}"></script>
	<script src="{{ asset('/js/ieBetter.js') }}"></script>
	<![endif]-->
</head>
<body>
	<!-- 页眉 -->
	<div class="rs-header">
		<div class="rs-container">
			<a href="{{ url('/') }}"><h1 class="fl pointer white">五四评优</h1></a>
			<nav id="nav-main" class="rs-nav fl">
				<ul class="rs-main-nav">
					<a href="{{ url('apply/apply') }}">
						<li name="common/message">我要申报</li>
					</a>
					<a href="{{ url('user/recommendations') }}">
						<li name="common/message">我的推荐</li>
					</a>
				</ul>
			</nav>
			<nav id="nav-user" class="rs-nav fr">
				@if (Auth::check())
				<ul class="rs-user-nav user-logged">
					<li class="user-avatar-outer"><img src="{{ asset('/img/avatar-' . Auth::user()->avatar . '.png') }}" class="user-avatar"></li>
					<a href="{{ url('user/update') }}"><li>更新资料</li></a>
					<a href="{{ url('user/logout') }}"><li>注销</li></a>
				</ul>
				@else
				<ul class="rs-user-nav">
					<a href="{{ url('user/login') }}"><li>登录</li></a>
				</ul>
				@endif
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
			<div>骄傲的使用来自©<a href="http://my.nuaa.edu.cn">纸飞机南航青年网络社区</a>的技术</div>
			<a class="tip">项目时间轴</a>
		</div>
	</div>
	<script>
		@yield('scripts')
	</script>
</body>
</html>