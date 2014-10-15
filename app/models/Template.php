<?php

class Template extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'title' => 'required',
		 'subject' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['content','title','subject'];

}