@extends('template.master')

@section('title')我的推荐@stop

@section('content')
@if ($recommendations->count() != 0)
	@foreach ($recommendations as $rec)
	<a href="{{ url('apply/show/' . $rec->apply_id) . '#apply_a_' . $rec->id }}">
		<div class="card-outer">
			<div class="card-inner">
				<h5 class="card-content">在“{{ $rec->apply->title }}（{{ $rec->apply->name }}）”中</h5>
				<blockquote class="card-content card-describtion">{{ $rec->content }}</blockquote>
			</div>
		</div>
	</a>
	@endforeach
@else
	<div class="rs-message">
		<div class="rs-container">
			<div class="rs-msg rs-msg-info">你还没有推荐任何人哦！</div>
		</div>
	</div>
@endif
@stop