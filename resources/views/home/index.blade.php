@extends('template.master')

@section('title')五四评优@stop

@section('content')
<h3>五四评优</h3>
<form action="{{ url('search/details') }}" method="get" class="rs-form">
	<span>校级评优：</span>
	<div class="rs-tabs">
		<a href="{{ url('search/school') }}" class="rs-tab">校级</a>
	</div>
	<span>院级评优：</span>
	<div class="rs-tabs">
		@foreach (trans('college') as $cid => $cname)
		<a href="{{ url('search/college/' . $cid) }}" class="rs-tab">{{ $cname }}</a>
		@endforeach
	</div>
	<fieldset>
		<legend>搜索</legend>
		<select name="type" id="type">
			<option value="stuid">学号</option>
			<option value="name">姓名</option>
		</select>
		<input type="text" name="key" style="display:inline-block;width:8em">
		<input type="submit" class="btn-success">
	</fieldset>
</form>

{{ $applies->render() }}

@stop