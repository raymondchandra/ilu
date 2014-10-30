<?php

class Promotion extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'name' => 'required',
		'amount' => 'required|regex:/^\d*(\.\d{2})?$/',
		'start_date' => 'required',
		'expired' => 'required',
		'active' => 'required|integer'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'amount', 'start_date', 'expired', 'active'];
	
	public function product()
	{
		return $this->hasMany('Product');
	}
}
