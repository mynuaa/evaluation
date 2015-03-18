<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlagUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('flag_user', function($table){
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('flag_id');

			$table->unique(['user_id', 'flag_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('flag_user');
	}

}
