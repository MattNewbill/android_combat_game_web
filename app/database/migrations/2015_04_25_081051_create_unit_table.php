<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Unit', function($table)
	    {
	        $table->increments('id');
	        $table->integer('row');
	        $table->integer('col');
	        $table->integer('hp');
	        $table->integer('armor');
	        $table->boolean('is_dead');
	        $table->smallInteger('direction_facing');
	        $table->string('name', 255);
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
		Schema::dropIfExists('Unit');
	}

}
