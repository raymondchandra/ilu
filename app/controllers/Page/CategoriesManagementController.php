<?php

class CategoriesManagementController extends \BaseController
{
	public function view_admin_category()
	{
		$sortBy = Input::get('sortBy','none');
		$sortType = Input::get('order','none');
		$filtered = Input::get('filtered','0');			
		$categoryController = new CategoriesController();
		$list_category = $categoryController->getListCategory();
				
		if($filtered == '0')
		{					
			if($sortBy === "none")
			{
				$categoriesJson = $categoryController->getAll();
			}
			else
			{
				$categoriesJson = $categoryController->getAllSorted($sortBy, $sortType);
			}
			
			$json = json_decode($categoriesJson->getContent());
					
			if($json->{'code'} == "200")
			{
				$paginator = $json->{'messages'};
										
				$perPage = 5;   
				$page = Input::get('page', 1);
				if ($page > count($paginator) or $page < 1)
				{
					$page = 1; 
				}
				$offset = ($page * $perPage) - $perPage;
				$articles = array_slice($paginator,$offset,$perPage);
				$categories = Paginator::make($articles, count($paginator), $perPage);
				$filtered = 0;
			}
			else
			{
				$page = null;
				$categories = $json;
			}
			
			return View::make('pages.admin.category.manage_category', compact('categories','list_category','sortBy','sortType','page','filtered'));
		}
		else
		{
			$id = Input::get('id', -1);
				if($id == '')				
				{
					$id = -1;
				}
			$name = Input::get('name', '');
				if($name == '')
				{
					$name = '';
				}	
			$parent_name = Input::get('parent_name', '');
				if($parent_name == '')
				{
					$parent_name = '';
				}	
			if($sortBy === "none")
			{
				$categoriesJson = $categoryController->getFilteredCategory($id, $name, $parent_name);								
			}			
			else
			{
				$categoriesJson = $categoryController->getFilteredCategorySorted($id, $name, $parent_name, $sortBy, $sortType);				
			}						
		
			$json = json_decode($categoriesJson->getContent());
			
			if($json->{'code'} == "200")
			{
				$paginator = $json->{'messages'};
				$categories = $paginator;
			}
			else
			{				
				$categories = null;
			}
			return View::make('pages.admin.category.manage_category', compact('categories','list_category','filtered','id','name','parent_name','sortBy','sortType'));
		}	
	}
	
	public function view_detail_category($id)
	{
		$categoryController = new CategoriesController();
		$json = json_decode($categoryController->getById($id)->getContent());
		return json_encode($json);
	}
	
	public function addCategory()
	{
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
		
		$name = $json->{'name'};
		$parent_category = $json->{'parent_category'};
		$deleted = $json->{'deleted'};
		
		$input = array(
				'name' => $name,
				'parent_category' => $parent_category,
				'deleted' => $deleted
		);
		
		$categoryController = new CategoriesController();
		$json = json_decode($categoryController->insert($input)->getContent());
		return json_encode($json);
	}
	
	public function editFull()
	{
		$json_data = Input::get('json_data');		
		$json = json_decode($json_data);				
		
		$id = $json->{'id'};
		$new_name = $json->{'name'};
		$new_parent_category = $json->{'parent_category'};
		
		$categoryController = new CategoriesController();
		$json = json_decode($categoryController->updateFull($id, $new_name, $new_parent_category)->getContent());
		
		return json_encode($json);
	}
	
	public function deleteCategory()
	{
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
		
		$id = $json->{'id'};		
		$new_deleted = $json->{'deleted'};
		
		$categoryController = new CategoriesController();
		$json = json_decode($categoryController->updateDeleted($id, $new_deleted)->getContent());
		return json_encode($json);
	}
}