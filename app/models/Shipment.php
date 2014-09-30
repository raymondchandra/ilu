<?php

class Shipment extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
	public function transaction()
	{
		return $this->hasMany('Transaction');
	}

	public function shipmentData()
	{
		return $this->belongsTo('ShipmentData');
	}
}