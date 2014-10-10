<?php

class Price extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [
        'attr_id',
        'attr_value',
        'product_id',
        'amount',
        'tax_id'
    ];

	public function product()
    {
        return $this->belongsTo('Product');
    }

    public function attribute()
    {
        return $this->belongsTo('Attribute','attr_id');
    }

    public function order()
    {
        return $this->hasMany('Order');
    }
    
    public function tax()
    {
        return $this->belongsTo('Tax');
    }
}