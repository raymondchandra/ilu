<?php

class Account extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['username','password','active','role','profile_id'];

	public function profile()
    {
        return $this->belongsTo('Profile');
    }

    public function transaction()
    {
    	return $this->hasMany('Transaction');
    }

    public function supportTicket()
    {
    	return $this->hasMany('SupportTicket');
    }

    public function wishlist()
    {
    	return $this->hasMany('Wishlist');
    }

    public function log()
    {
    	return $this->hasMany('Log');
    }

    public function cart()
    {
    	return $this->hasMany('Cart');
    }
}