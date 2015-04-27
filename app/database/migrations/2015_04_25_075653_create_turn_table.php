<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurnTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Turn', function($table)
	    {
	        $table->increments('id');
	        $table->boolean('is_host_turn');
	        $table->integer('turn_number');
	        $table->integer('host_user_id')->unsigned();
	        $table->integer('client_user_id')->unsigned();
	        $table->timestamps();

	        $table->foreign('host_user_id')->references('id')->on('user');
	    	$table->foreign('client_user_id')->references('id')->on('user');

	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('Turn');
	}

}
