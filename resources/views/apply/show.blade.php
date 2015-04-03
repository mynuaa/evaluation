@extends('template.master')

@section('title'){{ $apply->title }}@stop

@section('content')
<h3>{{ $apply->title }}</h3>
<div class="card-author cl">
	<img class="fl" src="{{ asset('/img/avatar-' . $apply->user->avatar . '.png') }}" alt="{{ $apply->name }}">
	<div class="fl">
		<div>{{ $apply->name }}，{{ $apply->stuid }}</div>
		<div>{{ $apply->major . trans('apply.professional') }}</div>
	</div>
	@if (Auth::check() && Auth::user()->isAdmin())
	<input type="button" value="删除" class="btn-danger fr" onclick="if(confirm('真特么要删？不考虑考虑了？'))window.location.href='{{ url('apply/delete/'.$apply->id) }}'">
	@endif
	<?php /*@if (Auth::check())
		@if (Auth::user()->name == $apply->name)
			<button class="fr btn" disabled>共{{ $apply->votes }}票</button>
		@else
			@if ($apply->isVoted)
			<input type="button" value="已投" class="fr" disabled>
			@else
			<input type="button" value="投票" class="btn-success fr" onclick="window.location.href='{{ url('apply/vote/'.$apply->id) }}'">
			@endif
		@endif
	@endif */?>
</div>
<h5>{{ trans('apply.photo') }}</h5>
<div class="row">
	@for ($i = 1; $i <= 3; $i++)
		@if ($apply['img' . $i] !== '')
		<div class="col-4">
			<img src="{{ url('photo') . '/' . $apply['img' . $i] }}" height="150" style="max-width:90%">
			<p>{{ $apply['intro' . $i] }}</p>
		</div>
		@endif
	@endfor
</div>
<h5>{{ trans('apply.whoami') }}</h5>
<p class="indent">{!! preg_replace('/(.+)[\r\n]/', '<p class="indent">$1</p>', htmlspecialchars($apply->whoami) . "\n") !!}</p>
<h5>{{ trans('apply.story') }}</h5>
<p class="indent">{!! preg_replace('/(.+)[\r\n]/', '<p class="indent">$1</p>', htmlspecialchars($apply->story) . "\n") !!}</p>
<h5>{{ trans('apply.disadvantages') }}</h5>
<p class="indent">{!! preg_replace('/(.+)[\r\n]/', '<p class="indent">$1</p>', htmlspecialchars($apply->insufficient) . "\n") !!}</p>
@if ($apply->tag1 != '')
<div class="rs-tabs" style="height:auto">
	<div class="rs-tab" title="{{ $apply->tag1 }}">{{ $apply->tag1 }}</div>
	@if ($apply->tag2 != '')<div class="rs-tab" title="{{ $apply->tag2 }}">{{ $apply->tag2 }}</div>@endif
	@if ($apply->tag3 != '')<div class="rs-tab" title="{{ $apply->tag3 }}">{{ $apply->tag3 }}</div>@endif
</div>
@endif
<hr>
<h3>{{ trans('apply.want_recommend') }}</h3>
@if (!Auth::check())
<div class="rs-msg rs-msg-warning"><a href="{{ url('user/login') }}">登录</a>之后才可以推荐哦！</div>
@elseif ($apply->isRecommended)
<div class="rs-msg rs-msg-info">{{ trans('message.recommend.before') }}</div>
@else
<form action='{{ url("apply/recommendation") }}' method="post" class="rs-form fullwidth" onsubmit="checkForm()">
	<input name='applyid' type='hidden' value="{{ $apply->id }}">
	<input name="_token" type="hidden" value="{{ csrf_token() }}">
	<textarea name="content" id="applyContent" class="fullwidth" placeholder="我想极力推荐{{ $apply->name }}同学，因为……"></textarea>
	<h5>注意事项</h5>
	<ul>
		<li>每人获得10个实名推荐即可获得参评资格。</li>
		<li>每个师生只可推荐5人，不区分学院。数量有限，请珍惜！</li>
		<li>推荐词至少50字，一定要言之有物</li>
		<li>无意义的简单字符、重复性内容会被审核为无效推荐！实名推荐，请对自己的名誉负责哈！</li>
	</ul>
	<div class="rs-form-btns">
		<input type="submit" value="{{ trans('apply.submit') }}" class="btn-success">
	</div>
</form>
@endif
<div id="card-transition" class="card-transition">
	@foreach ($apply->recommendations()->get() as $rec)
	<div class="card-outer" id="apply_a_{{ $rec->id }}">
		<div class="card-inner">
			<img class="cmt-avatar fr" src="{{ asset('/img/avatar-' . $rec->user->avatar . '.png') }}" alt="{{ $rec->user->name }}">
			<h5 class="card-content cmt-author">{{ $rec->user->name }}，{{ trans('college')[$rec->user->college] }}, {{ $rec->user->username }}</h5>
			<div class="card-content card-describtion">{{ $rec->content }}</div>
		</div>
	</div>
	@endforeach
</div>
 <p class="tip">
 	<span>{{ trans('apply.pageview', ['time' => $apply->pageview < 3000 ? $apply->pageview : '3000+']) }}</span>
{{--@if ($is_wechat)
	<span>收到了{{ $apply->like }}个赞。</span>	
	<a class="pointer" id="btnLike">
		<i class="fa fa-thumbs-o-up"></i>&nbsp;赞一下
	</a>
	@endif --}}
</p>
<h3>{{ trans('apply.want_share') }}</h3>
@include('template.share')
@stop

@section('scripts')
var hash=window.location.hash;
if(/apply_a_\d/.test(hash)){
	if(hash[0]=="#")hash=hash.substr(1);
	var d=document.getElementById(hash);
	d.className+=" card-important";
	setTimeout(function(){
		d.className=d.className.replace(" card-important","");
		setTimeout(function(){
			d=d.parentNode;
			d.className="";
		},2000);
	},100);
}
else{
	document.getElementById("card-transition").className="";
}
function checkForm(){
	if(document.getElementById("applyContent").value.length<50){
		alert({{ trans('apply.recommend_min', ['num' => 50]) }});
		return false;
	}
}
document.getElementById("btnLike").onclick=function(){
	var xhr=new XMLHttpRequest();
	xhr.open("GET",'{{ url('apply/like/' . $apply->id) }}',true);
	xhr.withCredentials=true;
	xhr.timeout=5000;
	xhr.send("");
	this.innerHTML='<i class="fa fa-thumbs-up"></i>&nbsp;已赞';
	this.onclick=function(){return false;};
};
@stop