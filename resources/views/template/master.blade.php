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
	<title>@yield('title') - {{ trans('app.nuaa').trans('app.name') }}</title>
	<!--[if lt IE 9]>
	<script src="{{ asset('/js/html5.js') }}"></script>
	<script src="{{ asset('/js/ieBetter.js') }}"></script>
	<![endif]-->
</head>
<body>
	<!-- 页眉 -->
	<div class="rs-header">
		<div class="rs-container">
			<a href="{{ url('/') }}"><img src="{{ asset('/img/nuaa_logo.png') }}" height="100%"></a>
			<a href="{{ url('/') }}"><h1 class="fl pointer white" class="fl">“五四”青年评优专题网站</h1></a>
			<nav id="nav-main" class="rs-nav fl">
				<ul class="rs-main-nav" onclick="this.classList.toggle('expand')">
					<a href="#">
						<li id="tabMenu">{{ trans('app.banner.menu') }}</li>
					</a>
					<a href="{{ url('call/main') }}">
						<li id="tabCall">{{ trans('app.banner.call') }}</li>
					</a>
					<a href="{{ url('apply/apply') }}">
						<li id="tabApp">{{ trans('app.banner.apply') }}</li>
					</a>
					<a href="{{ url('/') }}">
						<li id="tabMain">{{ trans('app.banner.recommend') }}</li>
					</a>
					<a href="{{ url('user/recommendations') }}">
						<li id="tabRec">{{ trans('app.banner.recommendation') }}</li>
					</a>
					<a href="{{ url('/') . '?lang=' . Lang::get('app.lang.value') }}">
						<li id="tabLang">{{ Lang::get('app.lang.name') }}</li>
					</a>
				</ul>
			</nav>
			<nav id="nav-user" class="rs-nav fr">
				@if (Auth::check())
				<ul class="rs-user-nav user-logged" id="tabUsr">
					<li class="user-avatar-outer"><img src="{{ asset('/img/avatar-' . Auth::user()->avatar . '.jpg') }}" class="user-avatar"></li>
					<a href="{{ url('user/update') }}"><li>{{ trans('app.banner.update') }}</li></a>
					<a href="{{ url('user/logout') }}"><li>{{ trans('app.banner.logout') }}</li></a>
				</ul>
				@else
				<ul class="rs-user-nav">
					<a href="{{ url('user/login') }}">
						<li id="tabUsr">{{ trans('app.banner.login') }}</li>
					</a>
				</ul>
				@endif
			</nav>
		</div>
	</div>
	<!-- 主体内容 -->
	<div class="rs-container">
		<!-- 消息显示块 -->
		<div class="rs-message">
			<!--[if lt IE 9]>
			<div class="rs-msg rs-msg-warning">
				{{ trans('app.ie') }}<a href="http://browsehappy.com/" target="_blank">{{ trans('app.download') }}</a>
			</div>
			<![endif]-->
			<div class="rs-msg rs-msg-warning">
				请修改登录默认密码，注意密码安全。如出现票数投向陌生人现象，请及时与校团委联系，并提供截图。
			</div>
			@if (Session::has('message'))
			<div class="rs-msg rs-msg-{{ session('message')['type'] }}">
				{{ session('message')['content'] }}
			</div>
			@endif
		</div>
		@yield('content')
	</div>
	<!-- 页脚 -->
	<div class="rs-footer center">
		<!-- 二维码 -->
		<div class="qrcode">
			<img src="{{ asset('/img/qrcode_tw.png') }}"><img src="{{ asset('/img/qrcode_zfj.png') }}">
		</div>
		<div class="rs-container">
			<div>{{ trans('app.moreinfo') }}</div>
			<div>{!! trans('app.powerby') !!}</div>
			<!-- <div>{{ trans('app.mail') }}<a href="mailto:nuaatw@163.com">nuaatw@163.com</a></div> -->
		</div>
	</div>
	<script>
		@yield('scripts')
		(function(window){
			var url=window.location.href;
			if(url.indexOf("user/recommendations")>=0)document.getElementById("tabRec").className+=" rs-nav-selected";
			else if(url.indexOf("apply/apply")>=0)document.getElementById("tabApp").className+=" rs-nav-selected";
			else if(url.indexOf("user")>=0)document.getElementById("tabUsr").className+=" rs-nav-selected";
			else if(url.indexOf("call")>=0)document.getElementById("tabCall").className+=" rs-nav-selected";
			else document.getElementById("tabMain").className+=" rs-nav-selected";
		})(window);
	</script>
</body>
</html>
