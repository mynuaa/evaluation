@extends('template.master')

@section('title'){{ trans('recommend.title') }}@stop

@section('content')
<h3>查看推荐数</h3>
<table>
<tr>
	<th>序号</th>
	<th>姓名</th>
	<th>学号</th>
	<th>被推荐数</th>
	<th>投票数</th>
	<th>查看详情</th>
</tr>
@foreach ($records as $key => $rec)
<tr>
	<td>{{ $key+1 }}</td>
	<td>{{ $rec->name }}</td>
	<td>{{ $rec->stuid }}</td>
	<td>{{ $rec->num }}</td>
	<td>{{ $rec->votes }}</td>
	<td><a href="{{ url('admin/showonerecommendations/' . $rec->apply_id) }}">查看详情</a></td>
</tr>
@endforeach
</table>

@stop
