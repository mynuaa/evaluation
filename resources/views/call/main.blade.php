@extends('template.master')

@section('title'){{ "我觉得TA可以！" }}@stop

@section('content')
<div class="page-title">揭发榜</div>

<a href="{{ url('call/call') }}">点击这里对心仪的人进行实名/匿名揭发！</a>

<br>
{{ $debug }}
@stop




@section('scripts')


@stop