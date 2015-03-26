@extends('template.master')

@section('title'){{ $apply->title }}@stop

@section('content')
<h3>{{ $apply->title }}</h3>
<div class="card-author cl">
	<img class="fl" src="{{ asset('/img/avatar-' . $apply->user->avatar . '.png') }}" alt="{{ $apply->name }}">
	<div class="fl">
		<div>{{ $apply->name }}，{{ $apply->stuid }}</div>
		<div>{{ $apply->major }}专业</div>
	</div>
	<input type="button" value="投票" class="btn-success fr" onclick="window.location.href='{{ url('apply/vote/'.$apply->id) }}'">
</div>
<h5>我是这样一个人</h5>
<p class="indent">{!! preg_replace('/(.+)[\r\n]/', '<p class="indent">$1</p>', htmlspecialchars($apply->whoami) . "\n") !!}</p>
<h5>我的故事</h5>
<p class="indent">{!! preg_replace('/(.+)[\r\n]/', '<p class="indent">$1</p>', htmlspecialchars($apply->story) . "\n") !!}</p>
<h5>我的不足</h5>
<p class="indent">{!! preg_replace('/(.+)[\r\n]/', '<p class="indent">$1</p>', htmlspecialchars($apply->insufficient) . "\n") !!}</p>
@if ($apply->tag1 != '')
<div class="rs-tabs" style="height:auto">
	<div class="rs-tab">{{ $apply->tag1 }}</div>
	@if ($apply->tag2 != '')<div class="rs-tab">{{ $apply->tag2 }}</div>@endif
	@if ($apply->tag3 != '')<div class="rs-tab">{{ $apply->tag3 }}</div>@endif
</div>
@endif
<p class="tip">浏览：{{ $apply->pageview }}次</p>
<hr>
<h3>我要推荐</h3>
@if ($apply->isRecommended)
<div class="rs-msg rs-msg-error">你已经推荐过这个人啦！</div>
@else
<form action='{{ url("apply/recommendation") }}' method="post" class="rs-form fullwidth">
	<input name='applyid' type='hidden' value="{{ $apply->id }}">
	<input name="_token" type="hidden" value="{{ csrf_token() }}">
	<textarea name="content" class="fullwidth" placeholder="我想极力推荐{{ $apply->name }}同学，因为……"></textarea>
	<div class="rs-form-btns">
		<input type="submit" value="推荐" class="btn-success">
	</div>
</form>
@endif
{!! $apply !!}
@foreach ($apply->recommendations as $rec)
{{$rec}}
@endforeach
<h3>我要分享</h3>
@include('template.share')
@stop