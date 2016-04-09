@extends('template.master')

@section('title') 数据列表 @stop

@section('content')
<style>
th{white-space:nowrap;text-align:center;}
</style>
<h1>数据列表</h1>
<table>
<tr>
	<th>姓名</th>
	<th>学号</th>
	<th>学院</th>
	<th>籍贯</th>
	<th>政治面貌</th>
	<th>专业</th>
	<th>事迹</th>
</tr>
@foreach ($data as $apply)
<tr>
	<td>{{ $apply->name }}</td>
	<td>{{ $apply->stuid }}</td>
	<td>{{ $apply->user->college }}</td>
	<td>{{ $apply->native_place }}</td>
	<td>{{ $apply->political }}</td>
	<td>{{ $apply->major }}</td>
	<td>{{ strip_tags($apply->story) }}</td>
</tr>
@endforeach
</table>
{!! $data->render() !!}
@stop