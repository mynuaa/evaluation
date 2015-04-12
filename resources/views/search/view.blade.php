@extends('template.master')

@section('title'){{ trans('app.name') }}@stop

@section('content')
<br>
<img src="{{ asset('/img/banner.jpg') }}" width="100%" alt="{{ trans('app.name') }}" class="hidden-phone">
<form action="{{ url('search/details') }}" method="get" class="rs-form">
	<div class="rs-tabs">
		<div class="rs-tabs-toggle hidden-tablet hidden-desktop pointer fa fa-chevron-down" onclick="toggleExpand(this)"></div>
		<a href="{{ url('/') }}" class="rs-tab">{{ trans('search.all') }}</a>
		<a href="{{ url('search/school') }}" class="rs-tab">{{ trans('search.school') }}</a>
		@foreach (trans('college') as $cid => $cname)
		<a href="{{ url('search/college/' . $cid) }}" class="rs-tab">{{ $cname }}</a>
		@endforeach
	</div>
	<div class="rs-message">
		<div class="rs-container">
			<div class="rs-msg rs-msg-info">
				{{ trans('app.statistics', $statistics) }}
			</div>
		</div>
	</div>
	@foreach(trans('app.notice') as $value)
	<div class="rs-message">
		<div class="rs-container">
			<div class="rs-msg rs-msg-{{ $value['type'] or 'info'}}">
				{{ isset($value['type']) ? strtoupper($value['type']) . ':' : "" }} {!! $value['content'] !!}
			</div>
		</div>
	</div>
	@endforeach
	<fieldset>
		<legend><b>{{ trans('search.global') }}</b></legend>
		<select name="type" id="type" style="width:5em">
			<option value="stuid">{{ trans('search.stuid') }}</option>
			<option value="name">{{ trans('search.name') }}</option>
		</select>
		<input type="search" name="key" style="display:inline-block;width:8em">
		<input type="submit" value="{{ trans('search.search') }}" class="btn-success">
	</fieldset>
</form>
@foreach ($applies as $stu)
<a href="{{ url('apply/show/' . $stu['id']) }}" class="no-underline" target="_blank">
	<div class="card-outer">
		<div class="card-inner">
			<div class="card-titles fullwidth">
				<div class="card-title">{{ $stu->title }}</div>
				<div class="card-content card-author">{{ $stu->name }}，{{ trans('apply.professional', ['name' => $stu->major]) }}</div>
			</div>
			<img src="{{ asset('/img/avatar-' . $stu->user->avatar . '.png') }}" alt="{{ $stu->name }}" class="card-avatar">
			<div class="card-content card-describtion">{{ substr($stu->whoami, 0, 150) . "..." }}</div>
		</div>
	</div>
</a>
@endforeach
{!! $applies->render() !!}
@stop

@section('scripts')
function toggleExpand(dom){
	dom.className=(dom.className.indexOf("-up")>=0)?dom.className.replace("-up","-down"):dom.className.replace("-down","-up");
	dom=dom.parentNode;
	if(dom.className.indexOf("rs-tabs-expand")>=0){
		dom.className=dom.className.replace(" rs-tabs-expand","");
	}
	else{
		dom.className+=" rs-tabs-expand";
	}
}
@stop