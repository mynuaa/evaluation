@extends('template.master')

@section('title'){{ "我觉得TA可以！" }}@stop

@section('content')
<script type="text/javascript" src="https://cdn.staticfile.org/jquery/3.1.1/jquery.min.js"></script>
<div class="page-title">{{ trans('call.title') }}</div>

<div class="rs-message">
	<div class="rs-msg rs-msg-info">如果你觉得谁棒棒，就推荐他吧来参加评选吧，</br>{{ trans('call.shortTitle') }}截止时间为4月9日8：00。</div>
</div>

<form action="#" method="post" class="rs-form left fullwidth" enctype="multipart/form-data">
	<fieldset class="form-group">
		<legend>基本信息</legend>
		<input name="name" type="text" placeholder="姓名" id="studentName">
		<input name="id" type="text" placeholder="学号(点我自动补全)" oninput="fillID()" id="schoolId">
		<!--这里需要悬浮层出学号-->
	</fieldset>
	<script>
	</script>
	<fieldset class="form-group">
		<legend>为啥推荐他</legend>
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

<script type="text/javascript">
function fillID(){
	studentName=document.getElementById('studentName').value;
	$.get('http://54.gg/call/studentid?name='+studentName, function(data) {
		console.log(data);
	});

	//console.log(document.getElementById('schoolId').value);
}
</script>

@stop

@section('scripts')

@stop
