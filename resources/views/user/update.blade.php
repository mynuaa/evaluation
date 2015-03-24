@extends('template.master')

@section('title')个人信息@stop

@section('content')
<div class="page-title">个人信息</div>
<div class="rs-form-outer">
	<form action="#" method="post" class="rs-form center">
		<div class="iconed-text">
			<i class="fa fa-user"></i>
			<input name="name" type="text" placeholder="真实姓名">
		</div>
		<div class="iconed-text">
			<i class="fa fa-lock"></i>
			<input name="college" type="text" placeholder="学院">
		</div>
		<div class="form-btns">
			<input type="submit" class="btn-success" value="更新">
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>
@stop