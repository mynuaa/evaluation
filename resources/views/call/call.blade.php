@extends('template.master')

@section('title'){{ "我觉得TA可以！" }}@stop

@section('content')
@include('UEditor::head')
<div class="page-title">{{ trans('call.title') }}</div>

<div class="rs-message">
	<div class="rs-msg rs-msg-info">如果你觉得谁好，就揭发他吧来参加评选吧，爸爸啦吧。</br>{{ trans('call.shortTitle') }}截止时间为4月9日8：00。</div>
</div>

<form action="#" method="post" class="rs-form left fullwidth" enctype="multipart/form-data">
	<fieldset class="form-group">
		<legend>基本信息</legend>
		<input name="name" type="text" placeholder="姓名">
		<input name="id" type="text" placeholder="学号(点我自动补全)" oninput="fillID()" id="schoolId"><!--这里需要悬浮层出学号-->
	</fieldset>
	<script>
	</script>
	<fieldset class="form-group">
		<legend>为啥推荐他</legend>
		<textarea name="reason" id="callReason" type="text" class="fullwidth" required></textarea>
	</fieldset>
	<fieldset class="form-group">
		<legend>匿名设置</legend>
		<input type="checkbox" name="anonymous" checked="">我要匿名检举
	</fieldset>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-btns">
		<input type="submit" class="btn-success" value="提交">
	</div>

</form>

<script type="text/javascript">
function fillID(){
	console.log(document.getElementById('schoolId').value);
}
</script>
{{ $debug }}

@stop

@section('scripts')

window.UEDITOR_CONFIG.serverUrl = "/evaluation/laravel-u-editor-server/server";
window.UEDITOR_CONFIG.toolbars = [[
	'undo', 'redo', '|',
	'bold', 'italic', 'underline', 'removeformat', '|',
	'fontsize', 'forecolor', '|', 'insertimage'
]];
window.UEDITOR_CONFIG.elementPathEnabled = false;
window.UEDITOR_CONFIG.indentValue = '2em';
var ue1 = UE.getEditor('callReason');
ue1.ready(function() { ue1.execCommand('serverparam', '_token', '{{ csrf_token() }}'); });

@stop
