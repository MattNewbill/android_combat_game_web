<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTurnTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('GameTurn', function($table)
	    {
	        $table->integer('game_id')->unsigned();
	        $table->integer('turn_id')->unsigned();

	        $table->foreign('game_id')->references('id')->on('game');
	    	$table->foreign('turn_id')->references('id')->on('Turn');
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('GameTurn');
	}

}
