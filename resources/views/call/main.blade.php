@extends('template.master')

@section('title'){{ "我觉得TA可以！" }}@stop

@section('content') 
<div class="page-title">揭发榜</div>

<a href="{{ url('call/call') }}">点击这里对心仪的人进行实名/匿名揭发！</a>

@foreach( $allcall as $key => $value)
	<div class="card-outer">
		<div class="card-inner">
			<div class="card-titles fullwidth">
				<div class="card-title">{{ $value['toId'] }}</div>
				<div class="card-content card-author">card-content</div>
			</div>
			<div class="card-content card-describtion"></div>
		</div>
	</div>
@endforeach


<br>
{{ $debug }}

@stop




@section('scripts')


@stop
