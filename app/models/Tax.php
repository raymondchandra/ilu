<?php

class Tax extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'amount' => 'required|regex:/^\d*(\.\d{2})?$/',
		'deleted' => 'required|integer'
	];

	// Don't forget to fill this array
	protected $fillable = ['amount', 'deleted'];

}

/*
method :
	insert()
	getAll()
	getAllAmountAsc()
	getAllAmountDesc()
	getById($id)
	getByAmountLessThanEqual($limit)
	getByAmountLessThanEqualAsc($limit)
	getByAmountLessThanEqualDesc($limit)
	getByAmountMoreThanEqual($limit)
	getByAmountMoreThanEqualAsc($limit)
	getByAmountMoreThanEqualDesc($limit)
	getByAmountBetweenEqual($lower_limit, $upper_limit)	
	getByAmountBetweenEqualAsc($lower_limit, $upper_limit)	
	getByAmountBetweenEqualDesc($lower_limit, $upper_limit)	
	getByDeleted($deleted)
	updateFull($id)
	updateDeleted($id, $new_deleted)
	updateAmount($id, $new_amount)
	delete($id)	
*/