<?php

class PaymentProff extends \Eloquent {
	
	// Add your validation rules here
	public static $rules = [
		'invoice' => 'required',
		'nama_pembayar' => 'required',
		'id_bank' => 'required',
		'bank_asal' => 'required',
		'norek_asal' => 'required',
		'nominal' => 'required'
	];
	
	protected $fillable = [
		'invoice',
		'nama_pembayar',
		'id_bank',
		'bank_asal',
		'norek_asal',
		'nominal'
	];
	
	// public function transaction()
	// {
		// return $this->belongsTo('Transaction');
	// }
	
	public function bank()
    {
    	return $this->belongsTo('Bank');
    }
}