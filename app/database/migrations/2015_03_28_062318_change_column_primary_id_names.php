<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnPrimaryIdNames extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user', function($table)
		{
		    $table->renameColumn('user_id', 'id');
		});
		Schema::table('game', function($table)
		{
		    $table->renameColumn('game_id', 'id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user', function($table)
		{
		    $table->renameColumn('', 'user_id');
		});
		Schema::table('game', function($table)
		{
		    $table->renameColumn('game_id', 'id');
		});
	}

}
