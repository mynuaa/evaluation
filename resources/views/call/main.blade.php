@extends('template.master')

@section('title'){{ "我觉得TA可以！" }}@stop

@section('content') 
<div class="page-title">未参评同学排行榜</div>

<a href="{{ url('call/call') }}" ><div class="rs-msg rs-msg-info" style="text-align: center;">点击这里 实名/匿名 推荐还未参加五四评优的同学上榜！</div></a>

@foreach( $allcall as $key => $value)
	<!--<div class="card-outer">
		<div class="card-inner">
			<div class="card-titles fullwidth">
				<div class="card-title">{{ $value['toId'] }}</div>
				<div class="card-content card-author">card-content</div>
			</div>
			<div class="card-content card-describtion">描述</div>
			<a onclick="like(this)" id="{{ $value['toId'] }}">点赞！！</a>
		</div>
	</div>-->
@endforeach

@foreach( $allcall as $key => $value)
	<div class="card-outer" id="{{ $value['toId'] }}">
		<div class="card-inner" style="position: relative;">
			<h5 class="card-content cmt-author"><名字> ，<学院>
			@if (Auth::check())
				，{{ $value['toId'] }}
			@endif
			</h5>
			<div style="float: right; position: absolute;top: 5px;right: 10px" onclick="like(this)"><i class="fa fa-heart fa-2x" aria-hidden="true" style="color: #E74C3C"></i></div>
			<div class="card-content card-describtion">{{ $allcontent[$value['toId']] }}</div>


		</div>
	</div>


@endforeach
<br>

@stop



<script type="text/javascript">

function like(e) {
	/*
	$.post('/call/like', {id: e.parentNode.parentNode.id ,_token:"{{ csrf_token() }}" }, function(data, textStatus, xhr) {
		console.log(data,textStatus,xhr);
	});*/

	fetch("./call/like", {
	  method: "POST",
	  body: "id="+e.parentNode.parentNode.id+"&_token={{ csrf_token() }}"

	}).then(function(res) {
	  if (res.ok) {
	    alert("Perfect! Your settings are saved.");
	  } else if (res.status == 401) {
	    console.log('error');
	  }
	}, function(e) {
	  console.log('error');
	});
}


</script>
@section('scripts')


@stop
