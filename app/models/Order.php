<?php

class Order extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [
	'price_id',
				'quantity',
				'transaction_id',
				];
	
	public function product()
	{
		return $this->belongsTo('Prices');
	}
	
	public function transaction()
	{
		return $this->belongsTo('Transaction');
	}

}