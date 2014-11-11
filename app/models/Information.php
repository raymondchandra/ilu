<?php

class Information extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [
		'title'
	];

	public function account()
    {
    	return $this->belongsTo('Account','edited_by');
    }
}