@extends('template.master')

@section('title') 数据列表 @stop

@section('content')
<h3>按学院分类</h3>
<div class="rs-tabs">
	<div class="rs-tabs-toggle hidden-tablet hidden-desktop pointer fa fa-chevron-down" onclick="toggleExpand(this)"></div>
	<a href="{{ url('apply/all') }}" class="rs-tab"><strong>全部</strong></a>
	@foreach (trans('college') as $cid => $cname)
	<a href="{{ url('apply/all?college=' . $cid) }}" class="rs-tab">{{ $cname }}</a>
	@endforeach
</div>
<style>
th{white-space:nowrap;text-align:center;}
</style>
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
	<td>{{ preg_replace('/[\ \t\n]+/', ' ', strip_tags($apply->story)) }}</td>
</tr>
@endforeach
</table>
{!! $data->render() !!}
@stop