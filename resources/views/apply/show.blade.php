@extends('template.master')

@section('title'){{ $apply->title }}@stop

@section('content')
<h3>{{ $apply->title }}</h3>
<div class="card-author cl">
	<img class="fl" src="{{ asset('/img/avatar-' . $apply->user->avatar . '.png') }}" alt="{{ $apply->name }}">
	<div class="fl">
		<div>{{ $apply->name }}（{{ $apply->stuid }}）</div>
		<div>{{ $apply->major }}专业</div>
	</div>
</div>
<div>
	<p class="tip">浏览：{{ $apply->pageview }}次</p>
</div>
<h5>我是这样一个人</h5>
<p class="indent">{!! preg_replace('/(.+)[\r\n]/', '<p class="indent">$1</p>', $apply->whoami . "\n") !!}</p>
<h5>我的故事</h5>
<p class="indent">{!! preg_replace('/(.+)[\r\n]/', '<p class="indent">$1</p>', $apply->story . "\n") !!}</p>
<h5>我的不足</h5>
<p class="indent">{!! preg_replace('/(.+)[\r\n]/', '<p class="indent">$1</p>', $apply->insufficient . "\n") !!}</p>
<div class="rs-form fullwidth">
	<div class="rs-form-btns">
		<input type="button" value="返回" class="btn-primary" onclick="window.history.go(-1)">
		<input type='button' value="投票" class="btn-success" onclick="window.location.href='{{ url('apply/vote/'.$apply->id) }}'">
	</div>
</div>
<h3>我要推荐</h3>
<form action='{{ url("apply/recommendation") }}' method="post" class="rs-form fullwidth">
	<input name='applyid' type='hidden' value="{{ $apply->id }}">
	<input name="_token" type="hidden" value="{{ csrf_token() }}">
	<textarea name="content" class="fullwidth" placeholder="我想极力推荐{{ $apply->name }}同学，因为……"></textarea>
	<div class="rs-form-btns">
		<input type="submit" value="推荐" class="btn-success">
	</div>
</form>
<h3>我要分享</h3>
@include('template.share')
@stop