@extends('template.master')

@section('title'){{ trans('apply.title') }}@stop

@section('content')
@include('UEditor::head')
<div class="page-title"><h5>{{$class}}班</h5>支部推荐</div>
<div class="rs-message">
    <div class="rs-msg rs-msg-info">应广大同学要求，申报截止时间为4月14日8：00。</div>
</div>
<div class="rs-form-outer fullwidth">
    <form action="#" method="post" class="rs-form left fullwidth" enctype="multipart/form-data">
        <fieldset class="form-group">
            <legend>请输入推荐同学的姓名及学号（最多可推荐三名同学）</legend>
            @if(isset($students[0]))
            <div class="rs-autocomplete-outer">
                <input name="class" type="hidden" value="{{$class}}" required>
                <input name="name1" type="text" placeholder="姓名" value="{{$students[0]->name}}" class="rs-autocomplete-input" autocomplete="off" disabled>
                <input name="id1" type="text" placeholder="学号" value="{{$students[0]->studentid}}" disabled>
            </div>
            @else
            <div class="rs-autocomplete-outer">
                <input name="class" type="hidden" value="{{$class}}" required>
                <input name="name1" type="text" placeholder="姓名" class="rs-autocomplete-input" autocomplete="off" required>
                <input name="id1" type="text" placeholder="学号" required>
            </div>
            @endif
        </fieldset>
        <fieldset class="form-group">
            @if(isset($students[1]))
            <div class="rs-autocomplete-outer">
                <input name="name2" type="text" placeholder="姓名" value="{{$students[1]->name}}" class="rs-autocomplete-input" autocomplete="off" disabled>
                <input name="id2" type="text" placeholder="学号" value="{{$students[1]->studentid}}" disabled>
            </div>
            @else
            <div class="rs-autocomplete-outer">
                <input name="name2" type="text" placeholder="姓名" class="rs-autocomplete-input" autocomplete="off">
                <input name="id2" type="text" placeholder="学号">
            </div>
            @endif
        </fieldset>
        <fieldset class="form-group">
            @if(isset($students[2]))
            <div class="rs-autocomplete-outer">
                <input name="name3" type="text" placeholder="姓名" value="{{$students[2]->name}}" class="rs-autocomplete-input" autocomplete="off" disabled>
                <input name="id3" type="text" placeholder="学号" value="{{$students[2]->studentid}}" disabled>
            </div>
            @else
            <div class="rs-autocomplete-outer">
                <input name="name3" type="text" placeholder="姓名" class="rs-autocomplete-input" autocomplete="off">
                <input name="id3" type="text" placeholder="学号">
            </div>
            @endif
        </fieldset>
        <div class="form-btns">
            <input type="submit" class="btn-success" value="{{ trans('apply.submit') }}">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</div>
<script>
</script>
@stop

@section('scripts')
@stop
