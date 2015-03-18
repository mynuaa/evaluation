<form action="#" method="post">
	<input name="name" type="text" placeholder="{{ $apply['name'] or '姓名' }}">
	<input name="college" type="number" placeholder="{{ $apply['college'] or '学院' }}">
	<input name="title" type="text" placeholder="{{ $apply['title'] or '给我起个标题' }}">

	<input name="sex" type="radio" value="M" checked>男
	<input name="sex" type="radio" value="F">女

	<input name="type" type="radio" value="0" checked>校级评选
	<input name="type" type="radio" value="1">院内评选

	<input name="native_place" type="text" placeholder="{{ $apply['native_place'] or '籍贯' }}">
	<input name="political" type="text" placeholder="{{ $apply['political'] or '政治面貌' }}">
	<input name="major" type="text" placeholder="{{ $apply['major'] or '主修专业' }}">

	<input name="whoami" type="text" placeholder="{{ $apply['whoami'] or '我是怎样的人' }}">
	<input name="story" type="text" placeholder="{{ $apply['story'] or '我的故事'}}">
	<input name="insufficient" type="text" placeholder="{{ $apply['insufficient'] or '我的不足'}}">

	<input type="submit">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>