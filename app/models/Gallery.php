<?php

class Gallery extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'product_id' => 'required|integer',
		// 'photo_path' => 'required',
		'type' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [
		'product_id',
		'photo_path',
		'type'];

	public function product()
	{
		return $this->belongsTo('Product');
	}
	
}