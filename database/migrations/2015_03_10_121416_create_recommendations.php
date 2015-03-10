<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recommendations', function($table){
			$table->increments('id');
			$table->integer('from_id');
			$table->integer('to_id');
			$table->text('content');

			$table->timestamps();
			$table->softDeletes();

			$table->unique(['to_id', 'from_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recommendations');
	}

}
