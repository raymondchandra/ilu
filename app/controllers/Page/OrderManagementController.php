<?php
use Carbon\Carbon;
class OrderManagementController extends \BaseController 
{
	public function view_order_mgmt()
	{
		$sortBy = Input::get('sortBy','none');
		$sortType = Input::get('order','none');
		$filtered = Input::get('filtered', '0');
		
		$order = new OrdersController();
		if($filtered == '0')
		{
			if($sortBy == 'none')
			{
				$json = $order->getAll();
			}else
			{
				$json = $order->getAllSort($sortBy, $sortType);
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
			return View::make('pages.admin.order.manage_order', compact('hasil', 'sortBy','sortType','page','filtered'));
		}else
		{
			$id = Input::get('id','-');
			$invoice = Input::get('invoice','-');
			$a = Input::get('purchasedOn','-');
			if($a == '')
			{
				$purchasedOn = '-';
			}else
			{
				$tahun = Carbon::parse($a)->format('Y');
				//echo $tahun;
				$bulan = Carbon::parse($a)->format('n');
				$tanggal = Carbon::parse($a)->format('d');
				$purchasedOn = $tahun.'-'.$bulan.'-'.$tanggal;
			}
			
			
			$name = Input::get('name','-');
			$nameProd = Input::get('nameProd','-');
			$qty = Input::get('qty','-');
			$hargaSatuan = Input::get('hargaSatuan','-');
			$hargaTotal = Input::get('hargaTotal','-');
			$status = Input::get('status','-');
			
			if($sortBy == "none")
			{
				$json = $order->getFilteredOrder($id, $invoice, $purchasedOn, $name, $nameProd, $qty, $hargaSatuan, $hargaTotal, $status);
			}else
			{
				$json = $order->getFilteredOrderSort($id, $invoice, $purchasedOn, $name, $nameProd, $qty, $hargaSatuan, $hargaTotal, $status, $sortBy, $sortType);
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
			
			return View::make('pages.admin.order.manage_order', compact('hasil','sortBy','sortType','page','filtered', 'id', 'invoice', 'purchasedOn', 'name', 'nameProd', 'hargaPengiriman', 'qty', 'hargaSatuan', 'hargaTotal','status'));
		}
	}
	
}