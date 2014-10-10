<?php

class Address extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	
	protected $fillable = ['address','city','province','country','company','postal','profile_id','is_main'];
	
	public function profile()
    {
        return $this->belongsTo('Profile');
    }
}