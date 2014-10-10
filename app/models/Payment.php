<?php

class Payment extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [
		'full_name',
		'transaction_id',
		'paid_amt',
		'bank_id',
		'date',
		'source_bank',
		'bank_acc_number',
		'bank_acc_owner'
	];

	public function transaction()
    {
    	return $this->belongsTo('Transaction');
    }

    public function bank()
    {
    	return $this->belongsTo('Bank');
    }
}