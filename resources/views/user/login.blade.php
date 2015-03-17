<form action="#" method="post">
	<input name="username" type="text"/>
	<input name="password" type="password" />
	<input type="submit" />
	<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
</form>