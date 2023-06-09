@extends('template.master')

@section('title'){{ trans('recommend.title') }}@stop

@section('content')
<h3>我的推荐</h3>
@if ($recommendations->count() != 0)
	@foreach ($recommendations as $rec)
	@if (!is_null($rec->apply))
		<div class="card-outer">
			<i class="del-recommendations fa fa-close" onclick="del_rec({{ $rec->id }},event)"></i>
			<div class="card-inner" onclick="location.href='{{ url('apply/show/' . $rec->apply_id) . '#apply_a_' . $rec->id }}'">
				<h5 class="card-content">
					{{ trans('recommend.where', ['title' => $rec->apply->title, 'name' => $rec->apply->name]) }}
				</h5>
				<blockquote class="card-content card-describtion">{{ $rec->content }}</blockquote>
			</div>
		</div>
	@endif
	@endforeach
@else
	<div class="rs-message">
		<div class="rs-msg rs-msg-info">{{ trans('recommend.none') }}</div>
	</div>
@endif
<hr>
<h3>我的投票</h3>
<div class="rs-message">
	<div class="rs-msg rs-msg-info">
		你已投同学院{{ $details['inner'] }}票，不同学院{{ $details['outer'] }}票。
	</div>
	<div class="rs-msg rs-msg-info">
	按照规则，总票数一共6票，投向其他学院票数不少于投向本学院票数的50%。
	</div>
	<!-- ，其中同学院必须最少1票，最多{{ config('business.vote.inner') - $details['inner'] }}票，不同学院不能少于{{ intval($details['inner']) / 2 }}票 -->
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
		<div class="rs-msg rs-msg-warning">{{ trans('vote.none') }}</div>
	</div>
@endif
@stop

@section('scripts')
function del_rec(id,event){
	event.preventDefault();
	if(!confirm("确定要删除该条推荐？"))return false;
	location.href="deleterecommendation?id="+id;
	return false;
}
@stop
