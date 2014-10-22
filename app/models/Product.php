<?php

class Product extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'product_no' => 'required|unique:products,product_no',
		'name' => 'required',
		'description' => 'required',
		'category_id' => 'required|integer',
		'promotion_id' => 'integer',
		'deleted' => 'required|integer'		
	];

	// Don't forget to fill this array
	protected $fillable = ['product_no', 'name', 'description', 'category_id', 'promotion_id', 'deleted'];


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