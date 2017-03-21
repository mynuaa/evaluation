@extends('template.master')

@section('title'){{ trans('recommend.title') }}@stop

@section('content')
<h3>查看推荐数</h3>
<table>
<tr>
	<th>姓名</th>
	<th>被推荐数</th>
	<th>查看详情</th>
</tr>
@foreach ($records as $rec)
<tr>
	<td>{{ $rec->name }}</td>
	<td>{{ $rec->num }}</td>
	<td><a href="{{ url('admin/showonerecommendations/' . $rec->apply_id) }}">查看详情</a></td>
</tr>
@endforeach
</table>

@stop