@extends('template.master')

@section('title') 404 NOT FOUND @stop

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
	<div id="header">404_Not_Found</div>
	<div id="head">你似乎访问了</div>
	<div id="head">一个<b>不存在</b>的页面</div>
	<div id="content">
		<li class="pointer" onclick="window.history.go(-1)">返回上一级</li>
	</div>
</div>
@stop