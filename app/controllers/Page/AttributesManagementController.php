<?php

class AttributesManagementController extends \BaseController
{
	public function view_admin_attribute()
	{
		$sortBy = Input::get('sortBy','none');
		$sortType = Input::get('order','none');
		$filtered = Input::get('filtered','0');			
		$attributeController = new AttributesController();
				
		if($filtered == '0')
		{					
			if($sortBy === "none")
			{
				$attributesJson = $attributeController->getAll();
			}
			else
			{
				$attributesJson = $attributeController->getAllSorted($sortBy, $sortType);
			}
			
			$json = json_decode($attributesJson->getContent());
					
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
				$attributes = Paginator::make($articles, count($paginator), $perPage);
				$filtered = 0;
			}
			else
			{
				$page = null;
				$attributes = $json;
			}
			
			return View::make('pages.admin.attribute.manage_attribute', compact('attributes','sortBy','sortType','page','filtered'));
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
			if($sortBy === "none")
			{
				$attributesJson = $attributeController->getFilteredAttribute($id, $name);								
			}			
			else
			{
				$attributesJson = $attributeController->getFilteredAttributeSorted($id, $name, $sortBy, $sortType);				
			}						
		
			$json = json_decode($attributesJson->getContent());
			
			if($json->{'code'} == "200")
			{
				$paginator = $json->{'messages'};
				$attributes = $paginator;
			}
			else
			{				
				$attributes = null;
			}
			return View::make('pages.admin.attribute.manage_attribute', compact('attributes','filtered','id','name','sortBy','sortType'));									
		}					
	}	

	public function view_detail_attribute($id)
	{
		$attributeController = new AttributesController();
		$json = json_decode($attributeController->getById($id)->getContent());
		return json_encode($json);
	}
	
	public function addAttribute()
	{
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
		
		$name = $json->{'name'};
		$deleted = $json->{'deleted'};
		
		$input = array(
				'name' => $name,
				'deleted' => $deleted
		);
		
		$attributeController = new AttributesController();
		$json = json_decode($attributeController->insert($input)->getContent());
		return json_encode($json);
	}
		
	public function editName()
	{		
		$json_data = Input::get('json_data');		
		$json = json_decode($json_data);
		
		$id = $json->{'id'};
		$new_name = $json->{'new_name'};
		
		$attributeController = new AttributesController();
		$json = json_decode($attributeController->updateName($id, $new_name)->getContent());
		return json_encode($json);
	}	
	
	public function deleteAttribute()
	{
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
		
		$id = $json->{'id'};		
		$new_deleted = $json->{'deleted'};
		
		$attributeController = new AttributesController();
		$json = json_decode($attributeController->updateDeleted($id, $new_deleted)->getContent());
		return json_encode($json);
	}
	
	
}