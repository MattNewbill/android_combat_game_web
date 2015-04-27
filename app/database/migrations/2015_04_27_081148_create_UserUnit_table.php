<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserUnitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('UserUnit', function($table)
	    {
	        $table->integer('user_id')->unsigned();
	        $table->integer('unit_id')->unsigned();
	        $table->integer('turn_id')->unsigned();

	        $table->foreign('user_id')->references('id')->on('user');
	    	$table->foreign('unit_id')->references('id')->on('Unit');
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
		Schema::dropIfExists('UserUnit');
	}

}
