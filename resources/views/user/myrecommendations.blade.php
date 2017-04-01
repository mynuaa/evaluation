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
	@if ($rec->anonymous === 0)
    	<td>{{ $rec->name }}</td>
	@else
	   <td>一个偷偷推荐我的人</td>
	@endif
		<td>{{ $rec->mainText }}</td>
		<td>{{ $rec->created_at }}</td>
	</tr>
	@endforeach
</tbody>

</table>

@stop
