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
		<select name="college">
			@foreach (trans('college') as $cid => $cname)
			<option value="{{ $cid }}"@if ($cid == substr($stuid, 0, 2)) selected @endif>{{ $cname }}</option>
			@endforeach
		</select>
		<div class="form-btns">
			<input type="submit" class="btn-success" value="更新">
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>
@stop