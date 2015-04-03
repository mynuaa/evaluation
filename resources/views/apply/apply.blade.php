@extends('template.master')

@section('title')个人申报@stop

@section('content')
<div class="page-title">个人申报</div>
<div class="rs-form-outer fullwidth">
	<form action="#" method="post" class="rs-form left fullwidth" enctype="multipart/form-data" onsubmit="checkForm()">
		<fieldset class="form-group">
			<legend>基本信息</legend>
			<input name="name" type="text" value="{{ $apply['name'] or Auth::user()->name }}" placeholder="姓名" disabled>
			<select name="college" disabled>
				<option value="{{ Auth::user()->college }}">{{ trans('college')[Auth::user()->college] }}</option>
			</select>
			<input name="title" type="text" value="{{ $apply['title'] }}" placeholder="自起标题" maxlength="15" required>
			<p class="tip">* 自起标题，将在评选网站首页、在扫码转朋友圈时体现，控制在15字以内。做个出色的标题党！</p>
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
			<p class="tip">* 如果你觉得熟悉自己、支持自己的人可能遍布全校而不仅限于本学院，则可选择“接受全校投票”；参与校级层面的“竞争”,得票可能多，但“竞争”更激烈。</p>
			<p class="tip"> * 如果你觉得自己社交圈子不是特别广、比较低调，熟悉自己、可能投自己票的人主要都在本学院，请选择“只接受本学院投票”,就是只参与院内“竞争”。</p>
			<p class="tip">* 申报者的事迹材料都可以被全校师生看到，不影响曝光率:)。两类别入选“百佳青年”的名额，将按照两类别报名人数占总报名人数的比例分配。</p>
		</fieldset>
		<fieldset class="form-group">
			<legend>详细信息</legend>
			<input name="native_place" type="text" value="{{ $apply['native_place'] }}" placeholder="籍贯" required>
			<input name="political" type="text" value="{{ $apply['political'] }}" placeholder="政治面貌" required>
			<input name="major" type="text" value="{{ $apply['major'] }}" placeholder="主修专业" required>
		</fieldset>
		<fieldset class="form-group">
			<legend>自我描述</legend>
			<textarea name="whoami" type="text" placeholder="介绍一下我是谁~将在评选网站首页出现，请字斟句酌。" class="fullwidth" required>{{ $apply['whoami'] }}</textarea>
			<textarea name="story" id="story" type="text" placeholder="我的故事（字数不少于400，没有上限）" class="fullwidth" required>{{ $apply['story'] }}</textarea>
			<textarea name="insufficient" type="text" placeholder="我的不足（有待继续努力的地方）" class="fullwidth" required>{{ $apply['insufficient'] }}</textarea>
		</fieldset>
		<legend>我的青春最精彩<span class="tip">&nbsp;&nbsp;图片展示区</span></legend>
		<div class="row">
			@for ($i = 1; $i <= 3; $i++)
			<div class="col-4">
				@if ($apply['img' . $i] !== '')
				<img src="{{ url('photo') . '/' . $apply['img' . $i] }}" height="150" style="max-width:90%;border-radius:5px">
				@else
				<div style="width:90%;height:150px;border:1px solid #BBB;border-radius:5px"></div>
				@endif
				<p><input type="file" name="imgs[]"></p>
				<p><input type="text" name="intros[]" placeholder="写点介绍吧！" @if ($apply['intro' . $i] !== '') value="{{ $apply['intro' . $i] }}" @endif></p>
			</div>
			@endfor
		</div>
		<p class="tip" style="color:red">* 请上传最能体现自己事迹特征、多彩生活、奋斗向上、充满正能量的照片。</p>
		<p class="tip" style="color:red">* 点击下面提交整个网页后图片才会保存。</p>
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
function checkForm(){
	if(document.getElementById("story").length<400){
		alert("“我的故事”必须大于400字！");
		return false;
	}
}
@stop