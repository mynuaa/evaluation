@extends('template.master')

@section('title'){{ trans('update.title') }}@stop

@section('content')
<div class="page-title">{{ trans('update.title') }}</div>
<div class="rs-form-outer">
	<form action="#" method="post" class="rs-form-aligned center">
		<p>
			<label for="name">{{ trans('update.real_name') }}：</label>
			<input name="name" id="name" type="text" value="{{ $user->name }}">
		</p>
		<p>
			<label for="college">{{ trans('update.college') }}：</label>
			<select name="college" id="college">
				@foreach (trans('college') as $cid => $cname)
				<option value="{{ $cid }}"@if ($cid == $user->college || (!$user->college && $cid == substr($user->username, 0, 2))) selected @endif>{{ $cname }}</option>
				@endforeach
			</select>
		</p>
		<div class="avatar-choose-outer">
			@for ($i = 0; $i < 10; $i++)
			<img src="{{ asset('/img/av	atar-' . $i . '.png') }}" class="avatar-choose @if ($user->avatar == $i) avatar-chosen @endif" onclick="setChosen(this)" alt="{{ trans('update.avatar') . $i }}">
			@endfor
		</div>
		<div class="form-btns">
			<input type="submit" class="btn-success" value="{{ trans('update.update') }}">
		</div>
		<input type="hidden" name="avatar" value="0" id="chosen">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>
@stop

@section('scripts')
function setChosen(dom){
	var list=dom.parentNode.querySelectorAll("img");
	for(var i=0;i<list.length;i++){
		if(list[i]==dom){
			dom.className+=" avatar-chosen";
			document.getElementById("chosen").value=i;
		}
		else list[i].className=list[i].className.replace(" avatar-chosen","");
	}
}
@stop