<?php

class Bank extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [
		'name',
		'acc_number',
		'acc_owner',
		'deleted'
	];

}