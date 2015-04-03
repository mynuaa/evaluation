@extends('template.master')

@section('title'){{ trans('recommend.title') }}@stop

@section('content')
@if ($recommendations->count() != 0)
	@foreach ($recommendations as $rec)
	<a href="{{ url('apply/show/' . $rec->apply_id) . '#apply_a_' . $rec->id }}">
		<div class="card-outer">
			<div class="card-inner">
				<h5 class="card-content">
					{{ trans('recommend.where', ['title' => $rec->apply->title, 'name' => $rec->apply->name]) }}
				</h5>
				<blockquote class="card-content card-describtion">{{ $rec->content }}</blockquote>
			</div>
		</div>
	</a>
	@endforeach
@else
	<div class="rs-message">
		<div class="rs-container">
			<div class="rs-msg rs-msg-info">{{ trans('recommend.none') }}</div>
		</div>
	</div>
@endif
@stop