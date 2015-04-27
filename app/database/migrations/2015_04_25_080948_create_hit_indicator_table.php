<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHitIndicatorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('HitIndicator', function($table)
	    {
	        $table->increments('id');
	        $table->integer('row');
	        $table->integer('col');
	        $table->smallInteger('direction');
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
		Schema::dropIfExists('HitIndicator');
	}

}
