@extends('template.master')

@section('title')首页@stop

@section('content')
<a href="{{ url('search/school') }}">校级</a>
<a href="{{ url('search/college') }}">院级</a>
	<li>
		<a href="{{ url('search/college/{id}') }}">**院</a>
	</li>

<form action='{{ url("search") }}' method='get'>
	<input name="by">
	<input name="type" value='stuid'>
	<input name="type" value='name'>
</form>
@stop