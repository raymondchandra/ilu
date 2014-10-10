<?php

class Tax extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'amount' => 'required|regex:/^\d*(\.\d{2})?$/',
		'deleted' => 'required|integer'
	];

	// Don't forget to fill this array
	protected $fillable = ['name','amount', 'deleted'];

}
