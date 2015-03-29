@extends('template.master')

@section('title')我的推荐@stop

@section('content')
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
@stop