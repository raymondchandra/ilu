<?php

class ShippingAgentManagementController extends \BaseController 
{
	public function view_shipping_agent_mgmt()
	{
		$shp = new ShipmentDatasController();
		$json = $shp->getAll();
		$hsl = json_decode($json->getContent());
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
		
		return View::make('pages.admin.shipping.manage_shipping_agent', compact('hasil'));
	}
	
}