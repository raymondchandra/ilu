<?php

class ShippingManagementController extends \BaseController 
{
	public function view_shipping_mgmt()
	{
		$shp = new ShipmentsController();
		$json = $shp->getAll();
		$hsl = json_decode($json->getContent());
		$paginator = $hsl->{'messages'};
		
		foreach($paginator as $key)
		{
			$key->status = Shipment::find($key->id)->transaction->status;
			$key->nama = Shipment::find($key->id)->transaction->account->profile->full_name;
		}
		
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1)
		{
			$page = 1; 
		}
		$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$hasil = Paginator::make($articles, count($paginator), $perPage);
		
		return View::make('pages.admin.shipping.manage_shipping', compact('hasil'));
	}
}