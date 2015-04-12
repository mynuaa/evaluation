<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Vote;

class AddTypeColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('votes', function($table){
			$table->integer('type');
		});

		foreach(Vote::all() as $value){
			$value->type = $value->apply->type;
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('votes', function($table){
			$table->dropColumn('type');
		});
	}

}
