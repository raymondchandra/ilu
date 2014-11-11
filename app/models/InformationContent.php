<?php

class InformationContent extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'id_information' => 'required',
		 'sub_title' => 'required',
		 'content' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [
		'sub_title',
		'content',
		'edited_by'
	];

	public function account()
    {
    	return $this->belongsTo('Account','edited_by');
    }
}