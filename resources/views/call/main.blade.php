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
			<div class="card-content card-describtion">描述</div>
			<a onclick="like('{{ $value['toId'] }}')" id="like-{{ $value['toId'] }}">点赞</a>
		</div>
	</div>
@endforeach


<br>

@stop




@section('scripts')
function like(id){
	console.log(id);
}

@stop
