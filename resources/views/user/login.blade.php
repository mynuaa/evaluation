@extends('template.master')

@section('title')
用户登录
@stop

@section('content')
<div class="rs-form-outer">
	<h3>用户登录</h3>
	<form action="#" method="post" class="rs-form center">
		<div class="iconed-text">
			<i class="fa fa-user"></i>
			<input type="text" name="username" placeholder="用户名">
		</div>
		<div class="iconed-text">
			<i class="fa fa-lock"></i>
			<input type="password" name="password" placeholder="密码">
		</div>
		<input type="submit" class="btn-success">
		<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
	</form>
</div>
@stop