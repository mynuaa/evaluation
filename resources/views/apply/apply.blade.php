<form action="#" method="post">
	<input name="name" type="text" placeholder="{{ $apply['name'] or '姓名' }}">

	<input name="opition" type="radio" value="0">学校推荐
	<input name="opition" type="radio" value="1">学院推荐

	<input name="whoami" type="text" placeholder="{{ $apply['whoami'] or '我是怎样的人' }}">
	<input name="story" type="text" placeholder="{{ $apply['story'] or '我的故事'}}">
	<input type="submit">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>