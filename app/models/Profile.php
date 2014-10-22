<?php

class Profile extends \Eloquent {
	public $acc_id;
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['member_id','full_name','name_in_profile','no_ktp','company_name','company_address','dob','email'];

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