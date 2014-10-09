<?php

class Attribute extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'name' => 'required|unique:attributes',
		'deleted' => 'required|integer'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'deleted'];

	public function price()
    {
        return $this->hasOne('Price','attr_id');
    }

}

/*
method :
	insert()
	getAll()
	getAllNameAsc()
	getAllNameDesc()
	getById()
	getByName($name)
	getByNameAsc($name)
	getByNameDesc($name)
	getByDeleted($deleted)
	//getByDeletedAscName($deleted)
	//getByDeletedDescName($deleted)
	updateFull($id)
	updateDeleted($id, $new_deleted)
	updateName($id, $new_name)
	delete($id)	
*/