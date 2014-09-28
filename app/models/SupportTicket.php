<?php

class SupportTicket extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function account()
    {
    	return $this->belongsTo('Account');
    }

    public function message()
    {
    	return $this->hasMany('SupportMsg','ticket_id');
    }
}