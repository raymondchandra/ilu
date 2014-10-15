<?php

class Gallery extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'photo_path' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['product_id','photo_path','type'];

	public function product()
	{
		return $this->belongsTo('Product');
	}
	
}