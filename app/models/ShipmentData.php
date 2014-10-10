<?php

class ShipmentData extends \Eloquent {

	protected $table = 'shipmentdatas';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'courier' => 'required',
		'destination' => 'required',
		'price' => 'required',
		'deleted'=>'required|integer'];

	
	// Don't forget to fill this array
	protected $fillable = ['courier', 'destination','price'];


}