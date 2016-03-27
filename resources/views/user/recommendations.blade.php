@extends('template.master')

@section('title'){{ trans('recommend.title') }}@stop

@section('content')
<h3>我的投票</h3>

<div class="rs-message">
	<div class="rs-msg rs-msg-info">
		@if( ($remain['inner'] == 0) && ($remain['outer'] == 0))
		您的投票已经全部生效，可以让人请客了嗯嗯~~
		@else
		同学院可投{{ $remain['inner'] }}票，不同学院可投{{ $remain['outer'] }}票。
		投满{{ config('business.vote.max') }}票生效，还差{{ $remain['vote'] }}票。
		@endif
	</div>
</div>

@if ($votes->count() != 0)
	@foreach ($votes as $rec)
	<a href="{{ url('apply/show/' . $rec->id) }}">
		<div class="card-outer">
			<div class="card-inner">
				<h5 class="card-content">
					{{ $rec->name }}
					{{ trans('app.type.' . config('business.type.' . $rec->type)) }}
					{{ trans('college.' . $rec->college) }}
				</h5>
			</div>
		</div>
	</a>
	@endforeach
@else
	<div class="rs-message">
		<div class="rs-msg rs-msg-info">{{ trans('vote.none') }}</div>
	</div>
@endif
<hr>
<h3>我的推荐</h3>
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
		<div class="rs-msg rs-msg-info">{{ trans('recommend.none') }}</div>
	</div>
@endif
@stop