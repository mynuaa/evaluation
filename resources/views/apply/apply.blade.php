@extends('template.master')

@section('title')个人申报@stop

@section('content')
<div class="page-title">个人申报</div>
<div class="rs-form-outer">
	<form action="#" method="post" class="rs-form left">
		<fieldset class="form-group">
			<legend>基本信息</legend>
			<input name="name" type="text" value="{{ $apply['name'] }}" placeholder="姓名">
			<input name="college" type="number" value="{{ $apply['college'] }}" placeholder="学院">
			<input name="title" type="text" value="{{ $apply['title'] }}" placeholder="给我起个标题">
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
			<input name="native_place" type="text" value="{{ $apply['native_place'] }}" placeholder="籍贯">
			<input name="political" type="text" value="{{ $apply['political'] }}" placeholder="政治面貌">
			<input name="major" type="text" value="{{ $apply['major'] }}" placeholder="主修专业">
		</fieldset>
		<fieldset class="form-group">
			<legend>自我描述</legend>
			<textarea name="whoami" type="text" placeholder="我是怎样的人" class="fullwidth">{{ $apply['whoami'] }}</textarea>
			<textarea name="story" type="text" placeholder="我的故事" class="fullwidth">{{ $apply['story'] }}</textarea>
			<textarea name="insufficient" type="text" placeholder="我的不足" class="fullwidth">{{ $apply['insufficient'] }}</textarea>
		</fieldset>
		<fieldset class="form-group">
			<legend>标签</legend>
			<div class="rs-tabs">
				<div class="rs-tab">学霸<a onclick="removeTag(this.parentNode)">×</a></div>
				<div class="rs-tab">+</div>
			</div>
		</fieldset>
		<input type="hidden" name="flags[]" value="好人">
		<input type="hidden" name="flags[]" value="学霸">
		<div class="form-btns">
			<input type="submit" class="btn-success" value="提交">
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>
@stop