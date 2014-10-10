<?php

class Review extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'product_id' => 'required|integer',
		'text' => 'required',
		'rating' => 'required|regex:/^\d*(\.\d{2})?$/',
		'approved' => 'required|integer'
	];

	// Don't forget to fill this array
	protected $fillable = ['product_id', 'text', 'rating', 'approved'];

	public function product()
	{
		return $this->belongsTo('Product');
	}
}
