@extends('template.master')

@section('title') 404 NOT FOUND @stop

@section('content')
<style>
	#contain{
		margin: 100px auto;
		max-width:350px;
		height: 300px;
		background: #E74C3C;
		border-radius: 5px;
		color: #FFF;

	}
	#header{
		background: #2ECC71;
		border-radius: 5px;
		padding: 10px 0;
		text-indent: 10px;
		
	}
	#head{
		font-size: 28px;
		text-align: center;
		margin-top: 10px;
	}
	#content{
		line-height: 20px;
		/*letter-spacing: 5px;*/
		padding-left: 30px;
		margin-top: 30px;
	}
	#content li{
		margin-top: 10px;
	}
</style>
<div id="contain">
	<div id="header">
		404_Not_Found
	</div>
	<div id="head">
		咦！？好像出错了！
	</div>
	<div id="content">
		<li>你可以尝试<b>刷新</b>页面</li>
		<li>返回上一级</li>
		<li>检查网络状况</li>
	</div>
</div>
@stop