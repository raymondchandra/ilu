<?php

class TaxesManagementController extends \BaseController
{
	public function view_admin_tax()
	{
		$sortBy = Input::get('sortBy','none');
		$sortType = Input::get('order','none');
		$filtered = Input::get('filtered','0');			
		$taxController = new TaxesController();
		
		if($filtered == '0')
		{					
			if($sortBy === "none")
			{
				$taxesJson = $taxController->getAll();
			}
			else
			{
				$taxesJson = $taxController->getAllSorted($sortBy, $sortType);
			}
			
			$json = json_decode($taxesJson->getContent());
					
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
				$taxes = Paginator::make($articles, count($paginator), $perPage);
				$filtered = 0;
			}
			else
			{
				$page = null;
				$taxes = $json;
			}
			
			return View::make('pages.admin.tax.manage_tax', compact('taxes','sortBy','sortType','page','filtered'));
		}
		else
		{			
			$name = Input::get('name', '');
				if($name == '')
				{
					$name = '';
				}
			$amount = Input::get('amount', -1);
				if($amount == '')				
				{
					$amount = -1;
				}
			if($sortBy === "none")
			{
				$taxesJson = $taxController->getFilteredTax($name, $amount);								
			}			
			else
			{
				$taxesJson = $taxController->getFilteredTaxSorted($name, $amount, $sortBy, $sortType);				
			}						
		
			$json = json_decode($taxesJson->getContent());
			
			if($json->{'code'} == "200")
			{
				$paginator = $json->{'messages'};
				$taxes = $paginator;
			}
			else
			{				
				$taxes = null;
			}
			return View::make('pages.admin.tax.manage_tax', compact('taxes','filtered','name','amount','sortBy','sortType'));									
		}
	}
	
	public function view_detail_tax($id)
	{
		$taxController = new TaxesController();
		$json = json_decode($taxController->getById($id)->getContent());
		return json_encode($json);
	}
	
	public function addTax()
	{
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
		
		$name = $json->{'name'};
		$amount = $json->{'amount'};
		$deleted = $json->{'deleted'};
		
		$input = array(
				'name' => $name,
				'amount' => $amount,
				'deleted' => $deleted
		);
		
		$taxController = new TaxesController();
		$json = json_decode($taxController->insert($input)->getContent());
		return json_encode($json);
	} 
	
	public function editFull()
	{
		$json_data = Input::get('json_data');		
		$json = json_decode($json_data);				
				
		$id = $json->{'id'};		
		$new_name = $json->{'name'};
		$new_amount = $json->{'amount'};
		
		$taxController = new TaxesController();
		$json = json_decode($taxController->updateFull($id, $new_name, $new_amount)->getContent());
		
		return json_encode($json);
	}
	
	public function deleteTax()
	{
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
		
		$id = $json->{'id'};		
		$new_deleted = $json->{'deleted'};
		
		$taxController = new TaxesController();
		$json = json_decode($taxController->updateDeleted($id, $new_deleted)->getContent());
		return json_encode($json);
	}
}