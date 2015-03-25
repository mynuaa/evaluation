@extends('template.master')

@section('title')用户搜索@stop

@section('content')
<img src="http://my.nuaa.edu.cn/source/plugin/evaluation/template/banner.jpg" width="100%" alt="五四评优" class="hidden-phone">
<form action="{{ url('search/details') }}" method="get" class="rs-form">
	<div class="rs-tabs">
		<div class="rs-tabs-toggle hidden-tablet hidden-desktop pointer" onclick="toggleExpand(this)"></div>
		<a href="{{ url('search/school') }}" class="rs-tab" style="background:#16A085">校级</a>
		@foreach (trans('college') as $cid => $cname)
		<a href="{{ url('search/college/' . $cid) }}" class="rs-tab">{{ $cname }}</a>
		@endforeach
	</div>
	<fieldset>
		<legend><b>搜索</b></legend>
		<select name="type" id="type">
			<option value="stuid">学号</option>
			<option value="name">姓名</option>
		</select>
		<input type="search" name="key" style="display:inline-block;width:8em">
		<input type="submit" value="搜索" class="btn-success">
	</fieldset>
</form>
@foreach ($applies as $stu)
<a href="{{ url('apply/show/' . $stu['id']) }}" class="no-underline">
	<div class="card-outer">
		<div class="card-inner">
			<div class="card-title"><img src="{{ asset('/img/avatar-' . $stu->user->avatar . '.png') }}" alt="{{ $stu->name }}">{{ $stu->title }}</div>
			<div class="card-content card-author">{{ $stu->name }}，{{ $stu->major }}专业</div>
			<div class="card-content card-describtion">{{ $stu->whoami }}</div>
		</div>
	</div>
</a>
@endforeach
{{-- $applies->render() --}}
@stop

@section('scripts')
function toggleExpand(dom){
	dom=dom.parentNode;
	if(dom.className.indexOf("rs-tabs-expand")>=0){
		dom.className=dom.className.replace(" rs-tabs-expand","");
	}
	else{
		dom.className+=" rs-tabs-expand";
	}
}
@stop