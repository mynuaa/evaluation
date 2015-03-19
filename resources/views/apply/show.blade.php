<form action="{{ url('vote/vote') }}" method="post">
	<input type='submit' value="投票">
</form>

<form action="{{ url('apply/recommendation') }}" method="post">
	<input type='text' name="content">
	<input type='submit' value="推荐">
	<input name="_token" type="hidden" value="{{ csrf_token() }}">
</form>