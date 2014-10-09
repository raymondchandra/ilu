<?php

class Category extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'name' => 'required|unique:categories',
		'parent_category' => 'integer',
		'deleted' => 'required|integer'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'parent_category', 'deleted'];

	public function product()
    {
    	return $this->hasOne('Product');
    }

    public function sub_category()
    {
    	return $this->hasMany('Category','parent_category');
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
	getByParentCategory($parent_category)
	updateFull($id)
	updateDeleted($id, $new_deleted)
	updateName($id, $new_name)
	updateParentCategory($id, $new_parent_category)
	delete($id)	
*/