<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username')->unique();
			$table->string('password', 60);

			$table->boolean('admin')->default(0);

			$table->integer('college');
			$table->string('name');
			$table->integer('avatar');

			$table->rememberToken();

			$table->timestamps();
			$table->softDeletes();

			$table->index(['username', 'password']);
			$table->index('admin');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
