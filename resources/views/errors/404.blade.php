@extends('template.master')

@section('title') 404 @stop

@section('content')
<style>
h1,#content{text-align:center;}
h1{font-size:5em;}
#back{display:block;text-align:center;margin:2em 0;}
</style>
<h1>{{ trans('error.404.title') }}</h1>
@foreach(trans('error.404.content') as $value)
	<div id="content">{{ $value }}</div>
@endforeach
<a id="back" href="#" onclick="history.go(-1)">{{ trans('error.back') }}</a>
@stop