@extends('template.master')

@section('title') 数据列表 @stop

@section('content')
<h1>数据列表</h1>
<table>
<tr>
	<th>姓名</th>
	<th>学号</th>
	<th>学院</th>
	<th>专业</th>
	<th>籍贯</th>
	<th>事迹</th>
</tr>
@foreach ($data as $apply)
<tr>
	<td>{{ $apply->name }}</td>
	<td>{{ $apply->stuid }}</td>
	<td>{{ trans('college')[$apply->user->college] }}</td>
	<td>{{ trans('apply.professional', ['name' => $apply->user->major]) }}</td>
	<td>{{ $apply->title }}</td>
	<td>{{ strip_tags($apply->story) }}</td>
</tr>
@endforeach
</table>
@stop