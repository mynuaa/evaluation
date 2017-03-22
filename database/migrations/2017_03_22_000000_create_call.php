<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCall extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('call', function($table){
			$table->increments('id');
			$table->integer('fromId');
			$table->integer('toId');
			$table->integer('anonymous');

			$table->tinyInteger('type');

			$table->integer('college');

			$table->string('mainText');

			$table->integer('like')->default(0);
			$table->integer('pageview')->default(0);


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
