@extends('template.master')

@section('title') 500 @stop

@section('content')
<style>
h1,#content{text-align:center;}
h1{font-size:5em;}
#back{display:block;text-align:center;margin:2em 0;}
</style>
<h1>{{ trans('error.500.title') }}</h1>
@foreach(trans('error.500.content') as $value)
	<div id="content">{{ $value }}</div>
@endforeach
<a id="back" href="#" class="pointer right" onclick="history.go(-1)">{{ trans('error.back') }}</a>
@stop