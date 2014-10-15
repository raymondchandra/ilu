<?php

class Wishlist extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'product_id' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [
		'account_id',
		'product_id'
	];

	public function account()
	{
		return $this->belongsTo('Account');
	}

	public function product()
	{
		return $this->belongsTo('Product');
	}
}