<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Turn extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'turn';


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function host_units() {

	}

	public function client_units() {
				//return $this->belongsToMany('Turn', 'GameTurn', 'game_id', 'turn_id');// <- this is the column name of the extra column we adding

		return $this->belongsToMany('Unit', 'UserUnit', 'turn_id', 'unit_id');// <- this is the column name of the extra column we adding

	}

}
