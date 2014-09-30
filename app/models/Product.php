<?php

class Product extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function category()
    {
        return $this->belongsTo('Category');
    }

    public function price()
    {
        return $this->hasMany('Price');
    }

    public function order()
    {
        return $this->hasMany('Order');
    }

    public function gallery()
    {
        return $this->hasMany('Gallery');
    }

    public function review()
    {
    	return $this->hasMany('Review');
    }

    public function promotion()
    {
    	return $this->belongsTo('Promotion');
    }

    public function wishlist()
    {
    	return $this->hasMany('Wishlist');
    }
}