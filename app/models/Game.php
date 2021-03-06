<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
class Game extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'game';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function turns()
    {
        return $this->belongsToMany('Turn', 'GameTurn', 'game_id', 'turn_id')->orderBy('turn_number','DESC');// <- this is the column name of the extra column we adding
    }

}
