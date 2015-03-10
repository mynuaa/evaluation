<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplies extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('applies', function($table){
			$table->increments('id');
			$table->integer('user_id');

			$table->tinyInteger('type');
			$table->tinyInteger('opition');

			$table->text('whoami');
			$table->longText('story');

			$table->integer('pageview');
			$table->integer('support');

			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('applies');
	}

}
