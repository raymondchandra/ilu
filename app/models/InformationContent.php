<?php

class InformationContent extends \Eloquent {

	public function account()
    {
    	return $this->belongsTo('Account','edited_by');
    }
}