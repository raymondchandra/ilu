<?php

class Profile extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function account()
    {
        return $this->hasOne('Account');
    }

    public function phone()
    {
    	return $this->hasMany('Phone');
    }

     public function address()
    {
    	return $this->hasMany('Address');
    }
}