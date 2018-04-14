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
	<meta name="renderer" content="webkit">
	<link rel="stylesheet" href="{{ asset('/css/rscss.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/font-awesome.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/main.css') }}">
	<style type="text/css">
		/*
		这里稳稳地再开那么一波倒车
		*/
		li.show{
			height: 100px !important;
			background: #AA0000;
			/*ceshiweb*/
		}

	</style>
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
			<a href="{{ url('/') }}">
				<h1 class="fl pointer white" class="fl">
				{{ trans('app.banner.title') }}
				</h1>
			</a>
			<nav id="nav-main" class="rs-nav fl">
				<ul class="rs-main-nav" onclick="this.classList.toggle('expand')">
					<a href="#">
						<li id="tabMenu">{{ trans('app.banner.menu') }}</li>
					</a>
					<a href="{{ url('/') }}">
						<li id="tabMain">
							{{ trans('app.banner.already') }}
						</li>
					</a>
					<a href="{{ url('apply/apply') }}">
						<li id="tabApp">
							{{ trans('app.banner.apply') }}
						</li>
					</a>

					<!--
						<div>{{ trans('app.banner.apply') }}</div>
						<ul style="margin: 0;padding: 0">
							<a href="{{ url('apply/apply') }}"><li style="width: 100%;" >自我推荐</li></a>
							<a href="{{ url('apply/masterapply') }}"><li style="width: 100%;background: #AA0000;z-index: 1;">支部推荐</li></a>
						</ul>
						此处一大波倒车 ta改变了中国 ta又改了回去
					-->
					<!-- <a href="{{ url('/') }}">
						<li style="width: 100%;" >{{ trans('app.banner.already') }}</li>
					</a> -->
					<!-- <li id="tabMain" style="height: 50px;width: 120px;z-index: 10;overflow: hidden;padding: 0">
						<div>{{ trans('app.banner.recommend') }}</div>
						<ul style="margin: 0;padding: 0">
							<a href="{{ url('/') }}"><li style="width: 100%;" >{{ trans('app.banner.already') }}</li></a>
							<a href="{{ url('call/main') }}"><li style="width: 100%;background: #AA0000;z-index: 1;">{{ trans('app.banner.notjoin') }}</li></a>
						</ul>
					</li>
					-->
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
					@if (Auth::user()->isAdmin())
					<ul class="rs-user-nav user-logged superAdmin" id="tabUsr">
						<li class="user-avatar-outer"><img src="{{ asset('/img/avatar-' . Auth::user()->avatar . '.png') }}" class="user-avatar"></li>
						<a href="{{ url('user/update') }}"><li>{{ trans('app.banner.update') }}</li></a>
						<a href="{{ url('admin/showrecommendation')}}"><li>{{ trans('app.banner.detail') }}</li></a>
						<a href="{{ url('user/logout') }}"><li>{{ trans('app.banner.logout') }}</li></a>
					@else
					<ul class="rs-user-nav user-logged" id="tabUsr">
						<li class="user-avatar-outer"><img src="{{ asset('/img/avatar-' . Auth::user()->avatar . '.png') }}" class="user-avatar"></li>
						<a href="{{ url('user/update') }}"><li>{{ trans('app.banner.update') }}</li></a>
					<a href="{{ url('user/logout') }}"><li>{{ trans('app.banner.logout') }}</li></a>
					@endif
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
				{{ trans('app.banner.warning') }}
			</div>
			<div class="rs-msg rs-msg-warning">
				{{ trans('app.banner.notes') }}
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
			const url=window.location.href;
			if(url.indexOf("user/recommendations")>=0)document.getElementById("tabRec").className+=" rs-nav-selected";
			else if(url.indexOf("apply/apply")>=0)document.getElementById("tabApp").className+=" rs-nav-selected";
			/*else if(url.indexOf("apply/masterapply")>=0)document.getElementById("tabApp").className+=" rs-nav-selected";*/
			else if(url.indexOf("user")>=0)document.getElementById("tabUsr").className+=" rs-nav-selected";
			//else document.getElementById("tabMain").className+=" rs-nav-selected";
			const tabMain=document.getElementById("tabMain");
			// tabMain.onclick=function(e){
			// 	tabMain.classList.toggle('show');
			// 	e.stopPropagation();
			// };
			/*
			tabApp.onclick=function(e){
				tabApp.classList.toggle('show');
				e.stopPropagation();
			};*/
			window.toggleExpand = function(dom){
				dom.className=(dom.className.indexOf("-up")>=0)?dom.className.replace("-up","-down"):dom.className.replace("-down","-up");
				dom=dom.parentNode;
				if(dom.className.indexOf("rs-tabs-expand")>=0){
					dom.className=dom.className.replace(" rs-tabs-expand","");
				}
				else{
					dom.className+=" rs-tabs-expand";
				}
			};
		})(window);
	</script>
</body>
</html>
