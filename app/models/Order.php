<?php

class Order extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'price_id' => 'required|integer',
		'quantity' => 'required|integer',
		'transaction_id' => 'required|integer'
	];

	// Don't forget to fill this array

	protected $fillable = ['price_id', 'quantity', 'transaction_id'];
	
	public function price()
	{
		return $this->belongsTo('Prices');
	}
	
	public function transaction()
	{
		return $this->belongsTo('Transaction');
	}

}