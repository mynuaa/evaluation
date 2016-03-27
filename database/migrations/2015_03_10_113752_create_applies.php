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

			$table->string('name');
			$table->string('stuid');
			$table->integer('college');
			$table->enum('sex', ['男', '女']);
			$table->string('native_place');
			$table->string('political');
			$table->string('major');

			$table->string('title');
			$table->text('whoami');
			$table->longText('story');
			$table->text('insufficient');

			$table->string('img1')->default('');
			$table->string('intro1')->default('');
			$table->string('img2')->default('');
			$table->string('intro2')->default('');
			$table->string('img3')->default('');
			$table->string('intro3')->default('');

			$table->string('tag1');
			$table->string('tag2');
			$table->string('tag3');

			$table->text('video_url');

			$table->integer('repost')->default(0);
			$table->integer('pageview')->default(0);
			$table->integer('like')->default(0);

			$table->integer('recommendations')->default(0);
			$table->integer('votes')->default(0);

			$table->timestamps();
			$table->softDeletes();

			$table->index(['type', 'college']);
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
