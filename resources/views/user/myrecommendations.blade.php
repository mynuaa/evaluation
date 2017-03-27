@extends('template.master')

@section('title'){{ trans('login.title') }}@stop

@section('content')

<table>
<thead>
	<th>他推荐了我</th>
	<th>推荐内容</th>
	<th>推荐时间</th>
</thead>
<tbody>
	@foreach ($one as $rec)
	<tr>
		<td>{{ $rec->name }}</td>
		<td>{{ $rec->content }}</td>
		<td>{{ $rec->created_at }}</td>
	</tr>
	@endforeach
</tbody>

</table>

@stop