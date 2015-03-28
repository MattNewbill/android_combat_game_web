<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('game', function($table)
    {
        $table->increments('game_id');
        $table->integer('host_player_id');
        $table->integer('client_player_id');
        $table->integer('game_mode_id');
        $table->integer('map_id');
        $table->string('password');
        $table->boolean('is_active');
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
		Schema::drop('game');
	}

}
