<?php

class ShippingManagementController extends \BaseController 
{
	public function view_shipping_mgmt()
	{
		$sortBy = Input::get('sortBy','none');
		$sortType = Input::get('order','none');
		$filtered = Input::get('filtered', '0');
	
		$shp = new ShipmentsController();
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
			return View::make('pages.admin.shipping.manage_shipping', compact('hasil','sortBy','sortType','page','filtered'));
			
		}else
		{
			$noPengiriman = Input::get('noPengiriman','-');
			$kurir = Input::get('kurir','-');
			$destinasi = Input::get('destinasi','-');
			$namaPenerima = Input::get('namaPenerima','-');
			$hargaPengiriman = Input::get('hargaPengiriman','-');
			$status = Input::get('status','-');
			
			if($sortBy == "none")
			{
				$json = $shp->getFilteredShipment($noPengiriman, $kurir, $destinasi, $namaPenerima, $hargaPengiriman, $status);
			}else
			{
				$json = $shp->getFilteredShipmentSort($noPengiriman, $kurir, $destinasi, $namaPenerima, $hargaPengiriman, $status, $sortBy, $sortType);
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
				
			return View::make('pages.admin.shipping.manage_shipping', compact('hasil','sortBy','sortType','page','filtered', 'noPengiriman', 'kurir', 'destinasi', 'namaPenerima', 'hargaPengiriman', 'status'));
		}
	}
}