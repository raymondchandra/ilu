<?php

class Category extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function product()
    {
    	return $this->hasOne('Product');
    }

    public function sub_category()
    {
    	return $this->hasMany('Category','parent_category');
    }
}