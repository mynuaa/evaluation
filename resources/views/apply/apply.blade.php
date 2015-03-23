@extends('template.master')

@section('title')个人申报@stop

@section('content')
<div class="page-title">个人申报</div>
<div class="rs-form-outer">
	<form action="#" method="post" class="rs-form left">
		<fieldset class="form-group">
			<legend>基本信息</legend>
			<input name="name" type="text" placeholder="{{ $apply['name'] or '姓名' }}">
			<input name="college" type="number" placeholder="{{ $apply['college'] or '学院' }}">
			<input name="title" type="text" placeholder="{{ $apply['title'] or '给我起个标题' }}">
		</fieldset>
		<fieldset class="form-group">
			<legend>性别</legend>
			<input name="sex" type="radio" value="M" checked id="male"><label for="male">男</label>
			<input name="sex" type="radio" value="F" id="female"><label for="female">女</label>
		</fieldset>
		<fieldset class="form-group">
			<legend>申请类型</legend>
			<input name="type" type="radio" value="0" checked id="school"><label for="school">校级评选</label>
			<input name="type" type="radio" value="1" id="department"><label for="department">院内评选</label>
		</fieldset>
		<fieldset class="form-group">
			<legend>详细信息</legend>
			<input name="native_place" type="text" placeholder="{{ $apply['native_place'] or '籍贯' }}">
			<input name="political" type="text" placeholder="{{ $apply['political'] or '政治面貌' }}">
			<input name="major" type="text" placeholder="{{ $apply['major'] or '主修专业' }}">
		</fieldset>
		<fieldset class="form-group">
			<legend>自我描述</legend>
			<textarea name="whoami" type="text" placeholder="{{ $apply['whoami'] or '我是怎样的人' }}" class="fullwidth"></textarea>
			<textarea name="story" type="text" placeholder="{{ $apply['story'] or '我的故事'}}" class="fullwidth"></textarea>
			<textarea name="insufficient" type="text" placeholder="{{ $apply['insufficient'] or '我的不足'}}" class="fullwidth"></textarea>
		</fieldset>
		<input type="submit" class="btn-success">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>
@stop