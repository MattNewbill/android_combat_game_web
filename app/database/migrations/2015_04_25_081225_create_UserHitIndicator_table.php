<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHitIndicatorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('UserHitIndicator', function($table)
	    {
	        $table->integer('user_id')->unsigned();
	        $table->integer('hit_indicator_id')->unsigned();
	        $table->integer('turn_id')->unsigned();

	        $table->foreign('user_id')->references('id')->on('user');
	    	$table->foreign('hit_indicator_id')->references('id')->on('HitIndicator');
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
		Schema::dropIfExists('UserHitIndicator');
	}

}
