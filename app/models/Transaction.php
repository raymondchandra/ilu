<?php

class Transaction extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'account_id' => 'required|integer',
		'total_price' => 'required|integer',
		'shipment_id' => 'required|integer',
		'cart_id' => 'required|array'
	];

	// Don't forget to fill this array
	protected $fillable = [
        'invoice',
        'account_id' ,
        'total_price',
        'voucher_id',
        'status',
        'paid',
        'shipment_id'
    ];

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