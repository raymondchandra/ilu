<?php

class SupportMsg extends \Eloquent {

	protected $table = 'supportmsgs';
	// Add your validation rules here
	public static $rules = [
		 'ticket_id' => 'required',
		'account_id' => 'required',
		'text' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [
		'ticket_id',
		'account_id',
		'text'
	];

	public function account()
    {
    	return $this->belongsTo('Account');
    }

    public function ticket()
    {
    	return $this->belongsTo('SupportTicket','ticket_id');
    }
}