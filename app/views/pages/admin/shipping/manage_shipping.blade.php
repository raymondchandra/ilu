@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Manage Shipping
				</h3>
				<a href="{{ URL::to('/test/manage_shipping_jeffry') }}" class="btn btn-default" style="float: right; margin-top: 20px;margin-left: 10px;" >Manage Shipping</a>
				<a href="{{ URL::to('/test/manage_shipping_agent_jeffry') }}" class="btn btn-info" style="float: right; margin-top: 20px;margin-left: 10px;" >Manage Shipping Agent</a>
			</div>
			<span class="clearfix"></span>
			<hr></hr>

			<div>
				@if($hasil != null)
				
					@if($filtered == 0)
						{{$hasil->appends(array('sortBy' => $sortBy, 'order' => $sortType, 'filtered'=>$filtered))->links()}}
					@else
							<button class="btn btn-success backButton" style="float: left; margin-top: 20px; margin-left: 20px; margin-bottom: 20px" data-toggle="modal" data-target=".pop_up_add_attribute">Back</button>
					@endif
					<table class="table table-striped table-hover table-condensed table-bordered">
						<thead class="table-bordered">
							<tr>
								<th class="table-bordered">
									<a href="javascript:void(0)">Nomor Pengiriman</a>
									@if($filtered == 0)
										@if($sortBy == "number")
											@if($sortType == "asc")
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'number', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'number', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif
										@else
											<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'number', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@endif	
									@else
										@if($sortBy == "number")
											@if($sortType == "asc")
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'number', 'order' => 'desc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'number', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
											@endif
										@else
											<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'number', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
										@endif
									@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered" width="120">
									<a href="javascript:void(0)">Kurir</a>
									@if($filtered == 0)
											@if($sortBy == "courier")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'courier', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif	
										@else
											@if($sortBy == "courier")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'courier', 'order' => 'desc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
											@endif
										@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Destinasi</a>
									@if($filtered == 0)
											@if($sortBy == "destination")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'destination', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif	
										@else
											@if($sortBy == "destination")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'destination', 'order' => 'desc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
											@endif
										@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Nama Penerima</a>
									@if($filtered == 0)
											@if($sortBy == "full_name")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'full_name', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif	
										@else
											@if($sortBy == "full_name")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'full_name', 'order' => 'desc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
											@endif
										@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Harga Pengiriman</a>
									@if($filtered == 0)
											@if($sortBy == "price")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'price', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif	
										@else
											@if($sortBy == "price")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'price', 'order' => 'desc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
											@endif
										@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Status</a>
									@if($filtered == 0)
											@if($sortBy == "status")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'status', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'status', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'status', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif	
										@else
											@if($sortBy == "status")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'status', 'order' => 'desc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'status', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'status', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
											@endif
										@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">

								</th>
							</thead>
							<thead>
								<tr>
									<td><input type="text" class="form-control input-sm noPengirimanFilter"></td>
									<td><input type="text" class="form-control input-sm kurirFilter"></td>
									<td><input type="text" class="form-control input-sm destinasiFilter"></td>
									<td><input type="text" class="form-control input-sm namaPenerimaFilter"></td>
									<td><input type="text" class="form-control input-sm hargaPengirimanFilter"></td>
									<td><input type="text" class="form-control input-sm statusFilter"></td>
									
									
									<td width=""><a class="btn btn-primary btn-xs filterButton">Filter</a></td>
								</tr>
							</thead>
							<tbody>
								
									@foreach($hasil as $key)
										
										
										<tr> 
											<td>{{$key->number}}</td>
											<td>{{$key->courier}}</td>
											<td>{{$key->destination}}</td>
											<td>{{$key->full_name}}</td>
											<td>{{$key->price}}</td>
											<td>{{$key->status}}</td>

											<td>
												<input type="hidden" value="{{$key->id}}">
												<button class="btn btn-info btn-xs viewShipping" data-toggle="modal" data-target=".pop_up_view_shipping">View</button>
												<!-- Button trigger modal class ".alertYesNo" -->
												<!-- <button class="btn btn-danger btn-xs" data-toggle="modal" data-target=".alertYesNo">Delete</button> -->
											</td>
										</tr>
									
									@endforeach
								
							</tbody>
						</table>
					</div>
				@elseif($hasil == null)
					@if($filtered == 0)
						Not found
					@elseif($filtered == 1)
						<button class="btn btn-success backButton" style="float: left; margin-top: 20px; margin-left: 20px; margin-bottom: 20px" data-toggle="modal" data-target=".pop_up_add_attribute">Back</button>
						<table class="table table-striped table-hover table-condensed table-bordered">
						<thead class="table-bordered">
							<tr>
								<th class="table-bordered">
									<a href="javascript:void(0)">Nomor Pengiriman</a>
									@if($filtered == 0)
										@if($sortBy == "number")
											@if($sortType == "asc")
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'number', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'number', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif
										@else
											<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'number', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@endif	
									@else
										@if($sortBy == "number")
											@if($sortType == "asc")
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'number', 'order' => 'desc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'number', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
											@endif
										@else
											<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'number', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
										@endif
									@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered" width="120">
									<a href="javascript:void(0)">Kurir</a>
									@if($filtered == 0)
											@if($sortBy == "courier")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'courier', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif	
										@else
											@if($sortBy == "courier")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'courier', 'order' => 'desc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
											@endif
										@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Destinasi</a>
									@if($filtered == 0)
											@if($sortBy == "destination")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'destination', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif	
										@else
											@if($sortBy == "destination")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'destination', 'order' => 'desc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
											@endif
										@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Nama Penerima</a>
									@if($filtered == 0)
											@if($sortBy == "full_name")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'full_name', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif	
										@else
											@if($sortBy == "full_name")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'full_name', 'order' => 'desc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
											@endif
										@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Harga Pengiriman</a>
									@if($filtered == 0)
											@if($sortBy == "price")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'price', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif	
										@else
											@if($sortBy == "price")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'price', 'order' => 'desc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
											@endif
										@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Status</a>
									@if($filtered == 0)
											@if($sortBy == "status")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'status', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'status', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'status', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif	
										@else
											@if($sortBy == "status")
												@if($sortType == "asc")
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'status', 'order' => 'desc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@else
													<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'status', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
												@endif
											@else
												<a href="{{action('ShippingManagementController@view_shipping_mgmt', array('sortBy' => 'status', 'order' => 'asc', 'filtered'=>  $filtered, 'noPengiriman'=>$noPengiriman, 'kurir'=>$kurir, 'destinasi'=>$destinasi, 'namaPenerima'=>$namaPenerima, 'hargaPengiriman'=>$hargaPengiriman, 'status'=>$status))}}">
											@endif
										@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">

								</th>
							</thead>
							<thead>
								<tr>
									<td><input type="text" class="form-control input-sm noPengirimanFilter"></td>
									<td><input type="text" class="form-control input-sm kurirFilter"></td>
									<td><input type="text" class="form-control input-sm destinasiFilter"></td>
									<td><input type="text" class="form-control input-sm namaPenerimaFilter"></td>
									<td><input type="text" class="form-control input-sm hargaPengirimanFilter"></td>
									<td><input type="text" class="form-control input-sm statusFilter"></td>
									
									
									<td width=""><a class="btn btn-primary btn-xs filterButton">Filter</a></td>
								</tr>
							</thead>
							<tbody>
									<tr> 
										<td colspan="7">Not Found</td>
									</tr>
							</tbody>
						</table>
					@endif
				@endif
			</div>
		</div>
	</div>
	
	@include('includes.modals.alertYesNo')
	@include('pages.admin.shipping.pop_up_view_shipping')
	<script>
		//filter button
		$('body').on('click','.filterButton',function(){
			$noPengiriman = $('.noPengirimanFilter').val();
			
			$kurir = $('.kurirFilter').val();
			$destinasi = $('.destinasiFilter').val();
			$namaPenerima = $('.namaPenerimaFilter').val();
			$hargaPengiriman = $('.hargaPengirimanFilter').val();
			$status = $('.statusFilter').val();
			window.location = "{{URL::route('jeffry.getShipping')}}" + "?filtered=1&noPengiriman="+$noPengiriman+"&kurir="+$kurir+"&destinasi="+$destinasi+"&namaPenerima="+$namaPenerima+"&hargaPengiriman="+$hargaPengiriman+"&status="+$status;
		});
		$('body').on('click','.backButton',function(){
			window.location = "{{URL::route('jeffry.getShipping')}}" ;
		});
		
		//view detail
		$('body').on('click','.viewShipping',function(){
			$acc_id = $(this).prev().val();
			$('.noPengiriman').html("");
			$('.namaKurir').html("");
			$('.tujuan').html("");
			$('.namaPenerima').html("");
			$('.hargaPengiriman').html("");
			$('#shipment_status').html("");
			$('#idShip').val("");
			$.ajax({
					type: 'GET',
					url: '{{URL::route('jeffry.getDetailShip')}}',
					data: {	
						"id": $acc_id
					},
					success: function(response){
						if(response['code'] == '404')
						{
							//$('#wishlistcontent').append("<td>agent tidak ditemukan</td>");
						}
						else
						{
							$('#idShip').val(response['messages'][0].id);
							$('.noPengiriman').text(response['messages'][0].number);
							$('.namaKurir').text(response['messages'][0].courier);
							$('.tujuan').text(response['messages'][0].destination);
							$('.namaPenerima').text(response['messages'][0].full_name);
							$('.hargaPengiriman').text(response['messages'][0].price);
							$('#shipment_status').text(response['messages'][0].status);
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');
		});
		
		//edit status
		$('body').on('click','#shipment_status_setter',function(){
			$statusBaru = $('#shipment_status_list').val();
			$id = $('#idShip').val();
			$.ajax({
					type: 'PUT',
					url: '{{URL::route('jeffry.putStatusShipment')}}',
					data: {	
						"id": $id,
						"status" : $statusBaru
					},
					success: function(response){
						if(response['code'] == '404')
						{
							alert('failed');
							location.reload();
						}
						else
						{
							
							alert('success');
							location.reload();
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');
		});
	</script>
	@stop