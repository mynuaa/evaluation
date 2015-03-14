<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageviews extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pageviews', function($table){
			$table->increments('id');

			$table->integer('uid')->nullable();
			$table->integer('ip')->unsigned();
			$table->string('url');
			$table->string('useragent');
			$table->string('refer')->nullable();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pageviews');
	}

}
