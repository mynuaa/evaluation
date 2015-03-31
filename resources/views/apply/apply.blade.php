@extends('template.master')

@section('title')个人申报@stop

@section('content')
<div class="page-title">个人申报</div>
<div class="rs-form-outer fullwidth">
	<form action="#" method="post" class="rs-form left fullwidth" enctype="multipart/form-data">
		<fieldset class="form-group">
			<legend>基本信息</legend>
			<input name="name" type="text" value="{{ $apply['name'] or Auth::user()->name }}" placeholder="姓名" disabled>
			<select name="college" disabled>
				<option value="{{ Auth::user()->college }}">{{ trans('college')[Auth::user()->college] }}</option>
			</select>
			<input name="title" type="text" value="{{ $apply['title'] }}" placeholder="标题" maxlength="15" required>
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
			<input name="native_place" type="text" value="{{ $apply['native_place'] }}" placeholder="籍贯" required>
			<input name="political" type="text" value="{{ $apply['political'] }}" placeholder="政治面貌" required>
			<input name="major" type="text" value="{{ $apply['major'] }}" placeholder="主修专业" required>
		</fieldset>
		<fieldset class="form-group">
			<legend>自我描述</legend>
			<textarea name="whoami" type="text" placeholder="我是怎样的人" class="fullwidth" required>{{ $apply['whoami'] }}</textarea>
			<textarea name="story" type="text" placeholder="我的故事" class="fullwidth" required>{{ $apply['story'] }}</textarea>
			<textarea name="insufficient" type="text" placeholder="我的不足" class="fullwidth" required>{{ $apply['insufficient'] }}</textarea>
		</fieldset>
		<legend>我的青春最精彩</legend>
		<div class="row">
			@for ($i = 1; $i <= 3; $i++)
			<div class="col-4">
				@if ($apply['img' . $i] !== '')
				<img src="{{ config('business.upload') . $apply['img' . $i] }}" width="100%">
				@else
				<p>还没有上传图片哦！</p>
				@endif
				<p><input type="file" name="imgs[]"></p>
				<p><input type="text" name="intros[]" placeholder="写点介绍吧！"></p>
			</div>
			@endfor
		</div>
		<fieldset class="form-group">
			<legend>标签</legend>
			<div class="rs-tabs" id="tags" style="height:auto;padding:0">
				@for ($i = 1; $i <= 3; $i++)
					@if ($apply['tag' . $i] != '')
						<div class="rs-tab">{{ $apply['tag' . $i] }}<a onclick="removeTag(this.parentNode)">×</a></div>
					@endif
				@endfor
				<div class="rs-tab" id="curTag" style="padding:0 8px 0 0;width:100px;white-space:nowrap">
					<input type="text" class="rs-tab" id="curValue" maxlength="15" style="margin:0;font-size:1em" placeholder="..." onmousedown="this.placeholder=''" onblur="this.placeholder='...'">
					<a onclick="addTag()" class="pointer" style="margin:0">+</a>
				</div>
			</div>
		</fieldset>
		<fieldset class="hidden" id="hiddens">
			@for ($i = 1; $i <= 3; $i++)
				@if ($apply['tag' . $i] != '')
					<input type="hidden" name="tags[]" value="{{ $apply['tag' . $i] }}">
				@endif
			@endfor
		</fieldset>
		<p>
			<input type="checkbox" id="promise" checked disabled>
			<label for="promise" style="width:auto;max-width:75%;line-height:1em;text-align:left;vertical-align:middle"><b>本人承诺</b>：如果当选百佳青年学生，愿意作为优秀学生典型至少参加一次优秀学生事迹交流类活动。</label>
		</p>
		<div class="form-btns">
			<input type="submit" class="btn-success" value="提交">
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>
@stop

@section('scripts')
function addTag(){
	if(document.querySelectorAll(".rs-tab").length==5){
		alert("最多只能添加三个标签哦~");
		return false;
	}
	var curTag=document.getElementById("curTag");
	var value=document.getElementById("curValue").value;
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
	curValue.value="";
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