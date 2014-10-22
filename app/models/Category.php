<?php

class Category extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'name' => 'required|unique:categories,name',
		'parent_category' => 'integer',
		'deleted' => 'required|integer'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'parent_category', 'deleted'];

	public function product()
    {
    	return $this->hasOne('Product');
    }

    public function sub_category()
    {
    	return $this->hasMany('Category','parent_category');
    }
}
