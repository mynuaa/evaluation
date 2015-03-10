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
			$table->integer('user_id')->unique();

			$table->tinyInteger('type');
			$table->tinyInteger('opition');

			$table->text('whoami');
			$table->longText('story');

			$table->integer('pageview');
			$table->integer('support');

			$table->integer('recommons');
			$table->integer('votes');

			$table->timestamps();
			$table->softDeletes();

			$table->index('user_id');
			$table->index(['type', 'opition']);
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
