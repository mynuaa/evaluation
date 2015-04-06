@extends('template.master')

@section('title') 500 NOT FOUND @stop

@section('content')
<style>
	#contain{
		margin: 20px auto;
		max-width:550px;
		height: 300px;
		background: #E74C3C;
		border-radius: 5px;
		color: #FFF;
	}
	#header{
		background: #2ECC71;
		padding: 10px 0;
		text-align: center;
		border-top-left-radius: 5px;
		border-top-right-radius: 5px;
	}
	#head{
		font-size: 28px;
		text-align: center;
		margin-top: 10px;
	}
	#content{
		padding-left: 30px;
	}
	#content li{
		margin-top: 10px;
	}
</style>
<div id="contain">
	<div id="header">{{ trans('error.500.title') }}</div>
	@foreach(trans('error.500.content') as $value)		
		<p id="content">{{ $value }}</p>
	@endforeach
	<p class="pointer right" onclick="window.history.go(-1)">{{ trans('error.back') }}&nbsp;&nbsp;&nbsp;</p>
</div>
@stop