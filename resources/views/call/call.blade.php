@extends('template.master')

@section('title')我觉得TA可以！@stop

@section('content')
<div class="page-title">我觉得TA可以！</div>

<div class="rs-message">
	<div class="rs-msg rs-msg-info">如果你觉得谁棒棒，就推荐他吧来参加评选吧！</br>{{ trans('call.shortTitle') }}截止时间为4月9日8：00。</div>
</div>

<form action="#" method="post" class="rs-form left fullwidth" enctype="multipart/form-data">
	<fieldset class="form-group">
		<legend>你要推荐谁</legend>
		<div class="rs-autocomplete-outer">
			<input name="name" type="text" placeholder="姓名" class="rs-autocomplete-input" autocomplete="off" required>
			<input name="id" type="text" id="stunum-hidden" readonly required>
			<ul class="rs-autocomplete-list"></ul>
		</div>
	</fieldset>
	<script>
	</script>
	<fieldset class="form-group">
		<legend>为什么推荐TA</legend>
		<textarea name="reason" id="callReason" type="text" class="fullwidth" required maxlength="144"></textarea>
	</fieldset>
	<fieldset class="form-group">
		<legend>匿名设置</legend>
		<input type="checkbox" name="anonymous" checked="">我要匿名
	</fieldset>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-btns">
		<input type="submit" class="btn-success" value="提交">
	</div>

</form>

<script>
'use strict';
// simple throttle
var timer = null;
function throttle(func, args, timeout) {
	return function () {
		if (timer) {
			clearTimeout(timer);
		}
		timer = setTimeout(function () {
			console.log('event fired');
			func(args);
		}, timeout);
	};
}
// get stunum data
function getData(dom) {
	var name = dom.value;
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState != 4 ||  xhr.status != 200) {
			return;
		}
		var data = JSON.parse(xhr.responseText);
		var target = dom.parentNode.querySelector('.rs-autocomplete-list');
		if (data.code == 1) {
			target.innerHTML = data.data.map(function (item) {
				return '<li>' + item.studentid + '</li>';
			}).join('');
		} else if (data.code == -1){
			target.innerHTML = '<li>没有这个人</li>';
		}
		dom.style.borderRadius = '4px 4px 0 0';
		target.className = 'rs-autocomplete-list show';
		// 用 onclick 不会重复添加监听器
		target.onclick = function (e) {
			var value = (e.srcElement || e.target).innerText;
			if (parseInt(value) > 0) {
				document.querySelector('#stunum-hidden').value = value;
			}
			dispose(dom);
		};
	};
	xhr.open('GET', '/evaluation/call/studentid?name=' + encodeURIComponent(name), true);
	xhr.send();
}
// dispose autocomplet list
function dispose(dom) {
	dom.style.borderRadius = '4px';
	var target = dom.parentNode.querySelector('.rs-autocomplete-list');
	target.className = 'rs-autocomplete-list';
}
// add event listener
var input = document.querySelector('.rs-autocomplete-input');
input.addEventListener('keydown', throttle(getData, input, 200));
input.addEventListener('click', function () { getData(input); });
input.addEventListener('blur', function () { setTimeout(function () { dispose(input); }, 500); });
</script>
@stop

@section('scripts')

@stop


