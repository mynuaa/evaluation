@extends('template.master')

@section('title'){{ trans('apply.title') }}@stop

@section('content')
<div class="page-title">{{ trans('apply.title') }}</div>
<div class="rs-form-outer fullwidth">
	<form action="#" method="post" class="rs-form left fullwidth" enctype="multipart/form-data" onsubmit="checkForm()">
		<fieldset class="form-group">
			<legend>{{ trans('apply.basic') }}</legend>
			<input name="name" type="text" value="{{ $apply['name'] or Auth::user()->name }}" placeholder="姓名" disabled>
			<select name="college" disabled>
				<option value="{{ Auth::user()->college }}">{{ trans('college')[Auth::user()->college] }}</option>
			</select>
			<input name="title" type="text" value="{{ $apply['title'] }}" placeholder="{{ trans('apply.self_title') }}" maxlength="15" required>
			@foreach(trans('apply.title_intro') as $key => $value)
			<p class="tip">* {{ $value }}</p>
			@endforeach
		</fieldset>
		<fieldset class="form-group">
			<legend>{{ trans('apply.gender') }}</legend>
			<input name="sex" type="radio" value="男" @if ($apply['sex'] == "男" || $apply['sex'] == '') checked @endif id="male"><label for="male">{{ trans('apply.male') }}</label>
			<input name="sex" type="radio" value="女" @if ($apply['sex'] == "女") checked @endif id="female"><label for="female">{{ trans('apply.famale') }}</label>
		</fieldset>
		<fieldset class="form-group">
			<legend>{{ trans('apply.type_of_application') }}</legend>
			<input name="type" type="radio" value="0" @if ($apply['type'] == 0 || $apply['type'] == '') checked @endif id="school"><label for="school">{{ trans('apply.university_vote') }}</label>
			<input name="type" type="radio" value="1" @if ($apply['type'] == 1) checked @endif id="department"><label for="department">{{ trans('apply.college_vote') }}</label>
			@foreach(trans('apply.type_intro') as $key => $value)
				<p class="tip">* {{ $value }}</p>
			@endforeach
		</fieldset>
		<fieldset class="form-group">
			<legend>{{ trans('apply.information') }}</legend>
			<input name="native_place" type="text" value="{{ $apply['native_place'] }}" placeholder="{{ trans('apply.nationality') }}" required>
			<input name="political" type="text" value="{{ $apply['political'] }}" placeholder="{{ trans('apply.political') }}" required>
			<input name="major" type="text" value="{{ $apply['major'] }}" placeholder="{{ trans('apply.major') }}" required>
		</fieldset>
		<fieldset class="form-group">
			<legend>{{ trans('apply.description') }}</legend>
			<textarea name="whoami" type="text" placeholder="{{ trans('apply.whoami_intro') }}" class="fullwidth" required>{{ $apply['whoami'] }}</textarea>
			<textarea name="story" type="text" placeholder="{{ trans('apply.story_intro') }}" class="fullwidth" required>{{ $apply['story'] }}</textarea>
			<textarea name="insufficient" type="text" placeholder="{{ trans('apply.disadvantages_intro') }}" class="fullwidth" required>{{ $apply['insufficient'] }}</textarea>
		</fieldset>
		<legend>{{ trans('apply.photo') }}<span class="tip">&nbsp;&nbsp;{{ trans('apply.photo_sub') }}</span></legend>
		<div class="row">
			@for ($i = 1; $i <= 3; $i++)
			<div class="col-4">
				@if ($apply['img' . $i] !== '')
				<img src="{{ url('photo') . '/' . $apply['img' . $i] }}" height="150" style="max-width:90%;border-radius:5px">
				@else
				<div style="width:90%;height:150px;border:1px solid #BBB;border-radius:5px"></div>
				@endif
				<p><input type="file" name="imgs[]"></p>
				<p><input type="text" name="intros[]" placeholder="{{ trans('apply.photo_placeholder') }}" @if ($apply['intro' . $i] !== '') value="{{ $apply['intro' . $i] }}" @endif></p>
			</div>
			@endfor
		</div>
		@foreach(trans('apply.photo_intro') as $value)
		<p class="tip" style="color:red">* {{ $value }}</p>
		@endforeach
		<fieldset class="form-group">
			<legend>{{ trans('apply.tag') }}</legend>
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
			<label for="promise" style="width:auto;max-width:75%;line-height:1em;text-align:left;vertical-align:middle"><b>{{ trans('apply.promise') }}</b>:&nbsp;{{ trans('apply.promise_content') }}</label>
		</p>
		<div class="form-btns">
			<input type="submit" class="btn-success" value="{{ trans('apply.submit') }}" disabled>
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>
@stop

@section('scripts')
function addTag(){
	if(document.querySelectorAll(".rs-tab").length==5){
		alert("{{ trans('apply.max_three') }}");
		return false;
	}
	var curTag=document.getElementById("curTag");
	var value=document.getElementById("curValue").value;
	if(value==""){
		alert("{{ trans('apply.not_empty') }}");
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