<form action="#" method="post">
	<input name="name" type="text" placeholder="姓名">

	<input name="opition" type="radio" value="0">学校推荐
	<input name="opition" type="radio" value="1">学院推荐

	<input name="whoami" type="text" placeholder="我是一个怎样的人">
	<input name="story" type="text" placeholder="我的故事">
	<input type="submit">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>