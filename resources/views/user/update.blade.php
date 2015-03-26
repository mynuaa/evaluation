@extends('template.master')

@section('title')个人信息@stop

@section('content')
<div class="page-title">个人信息</div>
<div class="rs-form-outer">
	<form action="#" method="post" class="rs-form-aligned center">
		<p>
			<label for="name">真实姓名：</label>
			<input name="name" id="name" type="text">
		</p>
		<p>
			<label for="college">学院：</label>
			<select name="college" id="college">
				@foreach (trans('college') as $cid => $cname)
				<option value="{{ $cid }}"@if ($cid == substr($user->username, 0, 2)) selected @endif>{{ $cname }}</option>
				@endforeach
			</select>
		</p>
		<div class="avatar-choose-outer">
			@for ($i = 0; $i < 10; $i++)
			<img src="{{ asset('/img/avatar-' . $i . '.png') }}" class="avatar-choose" alt="{{ '头像' . $i }}">
			@endfor
		</div>
		<div class="form-btns">
			<input type="submit" class="btn-success" value="更新">
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>
@stop