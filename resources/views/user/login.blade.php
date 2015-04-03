@extends('template.master')

@section('title'){{ trans('login.title') }}@stop

@section('content')
<div class="page-title">{{ trans('login.title') }}</div>
<div class="center">
	<ol class="left ilb tip-order" style="max-width:400px">
		@foreach(trans('login.intro') as $value)
			<li>{{ $value }}</li>
		@endforeach
	</ol>
</div>
<div class="rs-form-outer">
	<form action="#" method="post" class="rs-form center">
		<div class="iconed-text">
			<i class="fa fa-user"></i>
			<input type="text" name="username" placeholder="{{ trans('login.username') }}">
		</div>
		<div class="iconed-text">
			<i class="fa fa-lock"></i>
			<input type="password" name="password" placeholder="{{ trans('login.password') }}">
		</div>
		<div class="form-btns">
			<input type="submit" class="btn-success" value="{{ trans('login.login') }}">
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
	</form>
</div>
@stop