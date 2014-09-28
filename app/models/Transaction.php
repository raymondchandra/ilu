<?php

class Transaction extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function account()
    {
        return $this->belongsTo('Account');
    }

    public function voucher()
    {
        return $this->belongsTo('Voucher');
    }

    public function shipment()
    {
        return $this->belongsTo('Shipment');
    }

    public function order()
    {
        return $this->hasMany('Order');
    }

     public function payment()
    {
        return $this->hasOne('Payment');
    }

}