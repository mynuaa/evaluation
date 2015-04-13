@extends('template.master')

@section('title') 503 Service Unavailable @stop

@section('content')
<style>
	#contain{
		margin: 20px auto;
		max-width:350px;
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
		line-height: 20px;
		padding-left: 30px;
		margin-top: 30px;
	}
	#content li{
		margin-top: 10px;
	}
</style>
<div id="contain">
	<div id="header">503_Service_Unavailable</div>
	<p id="content" style="text-identent:5em">系统正在升级更新，请稍后。</p>
	<p id="content" style="text-align:right;">校团委&nbsp;&nbsp;&nbsp;</p>
</div>
@stop