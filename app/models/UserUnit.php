<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
class UserUnit extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	public $timestamps = false;
	protected $table = 'userunit';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

}
