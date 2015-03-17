<form action="#" method="post">
	<input name="name" type="text"/>
	<input name="college" type="text" />
	<input type="submit" />
	<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
</form>