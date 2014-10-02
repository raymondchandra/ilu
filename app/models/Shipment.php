<?php

class Shipment extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'number' => 'required',
		'shipmentData_id' => 'required|integer'
	];

	// Don't forget to fill this array
	protected $fillable = ['shipmentData_id', 'number'];
	
	public function transaction()
	{
		return $this->hasMany('Transaction');
	}

	public function shipmentData()
	{
		return $this->belongsTo('ShipmentData');
	}
}