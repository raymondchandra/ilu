<?php

class OrderManagementController extends \BaseController 
{
	public function view_order_mgmt()
	{
		$shp = new OrdersController();
		$json = $shp->getAll();
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
			$hasil = $hsl;
		}
		return View::make('pages.admin.order.manage_order', compact('hasil'));
	}
	
}