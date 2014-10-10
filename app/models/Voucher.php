<?php

class Voucher extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [
		'type',
		'amount',
		'account_id',
		'code'
	];
	
	public function transaction()
	{
		return $this->hasOne('Transaction');
	}

	public function account()
	{
		return $this->belongsTo('Account');
	}
}