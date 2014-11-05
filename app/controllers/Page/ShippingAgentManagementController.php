<?php

class ShippingAgentManagementController extends \BaseController 
{
	public function view_shipping_agent_mgmt()
	{
		$sortBy = Input::get('sortBy','none');
		$sortType = Input::get('order','none');
		$filtered = Input::get('filtered', '0');
		
		$shp = new ShipmentDatasController();
		if($filtered == '0')
		{
			if($sortBy == 'none')
			{
				$json = $shp->getAll();
			}else
			{
				$json = $shp->getAllSort($sortBy, $sortType);
			}
		
			$hsl = json_decode($json->getContent());
			if($hsl->{'code'} == "200")
			{
				$paginator = $hsl->{'messages'};
				
				$perPage = 5;   
				$page = Input::get('page', 1);
				if ($page > count($paginator) or $page < 1)
				{
					$page = 1; 
				}
				$offset = ($page * $perPage) - $perPage;
				$articles = array_slice($paginator,$offset,$perPage);
				$hasil = Paginator::make($articles, count($paginator), $perPage);
			}else
			{
				$page = null;
				$hasil = null;
			}
			$filtered = 0;
			return View::make('pages.admin.shipping.manage_shipping_agent', compact('hasil','sortBy','sortType','page','filtered'));
		}else
		{
			$id = Input::get('id','-');
			$courier = Input::get('courier','-');
			$destination = Input::get('destination','-');
			$price = Input::get('price','-');
			
			if($sortBy == "none")
			{
				$json = $shp->getFilteredShipmentAgent($id, $courier, $destination, $price);
			}else
			{
				$json = $shp->getFilteredShipmentAgentSort($id, $courier, $destination, $price, $sortBy, $sortType);
			}
			
			$json2 = json_decode($json->getContent());
			
			if($json2->{'code'} == "404")
			{
				$hasil = null;
			}
			else
			{
				$paginator = $json2->{'messages'};
				
				$hasil=$paginator;
			}
			
			return View::make('pages.admin.shipping.manage_shipping_agent', compact('hasil','sortBy','sortType','page','filtered', 'id', 'courier', 'destination', 'price'));
		}
	}
	
}