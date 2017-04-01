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
	@foreach ($real as $rec)
	<tr>
	@if ($rec->anonymous === 1)
    	<td>{{ $rec->name }}</td>
	@else
	   <td>他偷偷推荐了我</td>
	@endif
		<td>{{ $rec->mainText }}</td>
		<td>{{ $rec->created_at }}</td>
	</tr>
	@endforeach
</tbody>

</table>

@stop