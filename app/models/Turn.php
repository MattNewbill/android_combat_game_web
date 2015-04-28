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
		return $this->belongsToMany('Unit', 'UserUnit', 'turn_id', 'unit_id');
	}

	public function client_units() {
		return $this->belongsToMany('Unit', 'UserUnit', 'turn_id', 'unit_id');
	}

	public function host_hit_indicators() {
		return $this->belongsToMany('HitIndicator', 'UserHitIndicator', 'turn_id', 'hit_indicator_id');
	}

	public function client_hit_indicators() {
		return $this->belongsToMany('HitIndicator', 'UserHitIndicator', 'turn_id', 'hit_indicator_id');
	}

}
