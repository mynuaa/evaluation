@extends('template.master')

@section('title')个人申报@stop

@section('content')
<div class="page-title">个人申报</div>
<div class="rs-form-outer">
	<form action="#" method="post" class="rs-form left">
		<fieldset class="form-group">
			<legend>基本信息</legend>
			<input name="name" type="text" value="{{ $apply['name'] }}" placeholder="姓名">
			<select name="college">
				@foreach (trans('college') as $cid => $cname)
				<option value="{{ $cid }}"@if ($apply['college'] == $cid || ($apply['college'] == '' && $cid == substr($stuid, 0, 2))) selected @endif>{{ $cname }}</option>
				@endforeach
			</select>
			<input name="title" type="text" value="{{ $apply['title'] }}" placeholder="我的宣言">
		</fieldset>
		<fieldset class="form-group">
			<legend>性别</legend>
			<input name="sex" type="radio" value="男" @if ($apply['sex'] == "男" || $apply['sex'] == '') checked @endif id="male"><label for="male">男</label>
			<input name="sex" type="radio" value="女" @if ($apply['sex'] == "女") checked @endif id="female"><label for="female">女</label>
		</fieldset>
		<fieldset class="form-group">
			<legend>申请类型</legend>
			<input name="type" type="radio" value="0" @if ($apply['type'] == 0 || $apply['type'] == '') checked @endif id="school"><label for="school">校级评选</label>
			<input name="type" type="radio" value="1" @if ($apply['type'] == 1) checked @endif id="department"><label for="department">院内评选</label>
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
			<div class="rs-tabs" id="tags">
				@for ($i = 1; $i <= 3; $i++)
					@if ($apply['tag' . $i] != '')
						<div class="rs-tab">{{ $apply['tag' . $i] }}<a onclick="removeTag(this.parentNode)">×</a></div>
					@endif
				@endfor
				<input type="text" id="curTag" class="rs-tab" placeholder="..." onmousedown="this.placeholder=''" onblur="this.placeholder='...'">
				<a onclick="addTag()" class="pointer">+</a>
			</div>
		</fieldset>
		<fieldset class="hidden" id="hiddens">
			@for ($i = 1; $i <= 3; $i++)
				@if ($apply['tag' . $i] != '')
					<input type="hidden" name="tags[]" value="{{ $apply['tag' . $i] }}">
				@endif
			@endfor
		</fieldset>
		<div class="form-btns">
			<input type="submit" class="btn-success" value="提交">
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>
@stop

@section('scripts')
function addTag(){
	if(document.querySelectorAll(".rs-tab").length-1==3){
		alert("最多只能添加三个标签哦~");
		return false;
	}
	var curTag=document.getElementById("curTag");
	var value=curTag.value;
	if(value==""){
		alert("标签内容不能为空！");
		return false;
	}
	var input=document.createElement("input");
	input.className="tag_"+value;
	input.type="hidden";
	input.name="tags[]";
	input.value=value;
	document.getElementById("hiddens").appendChild(input);
	var tag=document.createElement("div");
	tag.className="rs-tab";
	tag.innerHTML=value+'<a onclick="removeTag(this.parentNode)">×</a>';
	document.getElementById("tags").insertBefore(tag,curTag);
	curTag.value="";
	curTag.blur();
}
function removeTag(dom){
	var tagName=dom.innerText.replace("×","");
	var list=document.querySelectorAll(".tag_"+tagName);
	for(var i=0;i<list.length;i++){
		list[i].parentNode.removeChild(list[i]);
	}
	dom.parentNode.removeChild(dom);
}
@stop