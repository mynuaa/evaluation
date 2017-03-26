@extends('template.master')

@section('title'){{ trans('recommend.title') }}@stop

@section('content')
<h3>{{ $owner->name }}</h3>
<table>
<tr>
	<th>推荐者</th>
	<th>推荐内容</th>
	<th>推荐时间</th>
</tr>
@foreach ($records as $rec)
<tr>
	<td>{{ $rec->name }}</td>
	<td>{{ $rec->content }}</td>
	<td>{{ $rec->created_at }}</td>
</tr>
@endforeach
</table>

@stop