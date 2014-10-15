<?php

class Cart extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'account_id' => 'required|integer',
		'price_id' => 'required|integer',
		'quantity' => 'required|integer'
	];

	// Don't forget to fill this array
	protected $fillable = [
		'account_id',
		'price_id',
		'quantity'
	];

	 public function account()
    {
        return $this->belongsTo('Account');
    }

     public function price()
    {
        return $this->belongsTo('Price');
    }
}