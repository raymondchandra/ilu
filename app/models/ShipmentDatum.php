<?php

class ShipmentDatum extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'courier' => 'required',
		'destination' => 'required',
		'price' => 'required',
		'deleted'=>'required|integer'
	];
	
	// Don't forget to fill this array
	protected $fillable = ['courier', 'destination','price'];

	// Don't forget to fill this array
	protected $fillable = [];

}