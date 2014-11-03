@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">

			<div class="s_title_n_control">
				<h3 style="float: left;">
					Manage Order
				</h3>
								<!--	
								<a href="add_product_00" class="btn btn-success" style="float: right; margin-top: 20px;">+ Add Product</a>
							-->
						</div>
						<span class="clearfix"></span>
						<hr></hr>

						<div>
							
							@if($filtered == 0)
								{{$hasil->appends(array('sortBy' => $sortBy, 'order' => $sortType, 'filtered'=>$filtered))->links()}}
							@else
									<button class="btn btn-success backButton" style="float: left; margin-top: 20px; margin-left: 20px; margin-bottom: 20px" data-toggle="modal" data-target=".pop_up_add_attribute">Back</button>
							@endif
							<table class="table table-striped table-hover table-condensed">
								<thead class="table-bordered">
									<tr>
										<th class="table-bordered">
											<a href="javascript:void(0)">Order No.</a>
												@if($filtered == 0)
													@if($sortBy == "id")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'id', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'id', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'id', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
													@endif	
												@else
													@if($sortBy == "id")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'id', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'id', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'id', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
													@endif
												@endif
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Invoice</a>
											@if($filtered == 0)
													@if($sortBy == "invoice")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'invoice', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'invoice', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'invoice', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
													@endif	
												@else
													@if($sortBy == "invoice")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'invoice', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'invoice', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'invoice', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
													@endif
												@endif
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Purchased On</a>
											@if($filtered == 0)
													@if($sortBy == "created_at")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'created_at', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'created_at', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'created_at', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
													@endif	
												@else
													@if($sortBy == "created_at")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'created_at', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'created_at', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'created_at', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
													@endif
												@endif
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Bill to Name</a>
											<a href="javascript:void(0)">
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Ship to Name</a>
											@if($filtered == 0)
													@if($sortBy == "full_name")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'full_name', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
													@endif	
												@else
													@if($sortBy == "full_name")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'full_name', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
													@endif
												@endif
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Product Name</a>
											@if($filtered == 0)
													@if($sortBy == "name")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'name', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'name', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'name', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
													@endif	
												@else
													@if($sortBy == "name")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'name', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'name', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'name', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
													@endif
												@endif
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Qty</a>
											@if($filtered == 0)
													@if($sortBy == "quantity")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'quantity', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'quantity', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'quantity', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
													@endif	
												@else
													@if($sortBy == "quantity")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'quantity', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'quantity', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'quantity', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
													@endif
												@endif
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Harga Satuan</a>
											@if($filtered == 0)
													@if($sortBy == "priceNow")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'priceNow', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'priceNow', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'priceNow', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
													@endif	
												@else
													@if($sortBy == "priceNow")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'priceNow', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'priceNow', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'priceNow', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
													@endif
												@endif
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Harga Total</a>
											@if($filtered == 0)
													@if($sortBy == "total_price")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'total_price', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'total_price', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'total_price', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
													@endif	
												@else
													@if($sortBy == "total_price")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'total_price', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'total_price', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'total_price', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
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
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'status', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'status', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'status', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
													@endif	
												@else
													@if($sortBy == "status")
														@if($sortType == "asc")
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'status', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@else
															<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'status', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
														@endif
													@else
														<a href="{{action('OrderManagementController@view_order_mgmt', array('sortBy' => 'status', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'invoice'=>$invoice, 'purchasedOn'=>$purchasedOn, 'name'=>$name, 'nameProd'=>$nameProd, 'qty'=>$qty, 'hargaSatuan'=>$hargaSatuan, 'hargaTotal'=>$hargaTotal, 'status'=>$status))}}">
													@endif
												@endif
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">Action
										</th>
									</tr>
								</thead>
								<thead>
									<tr>
											<td ><input type="text" class="form-control input-sm idFilter"></td>
											<td><input type="text" class="form-control input-sm invoiceFilter"></td>
											<td width="200">
												<input type="text" id='datepicker00' class="form-control input-sm purchasedOnFilter" style="display: inline-block;"/>
												<script type="text/javascript">
												$(function () {
													$('#datepicker00').datepicker();
												});
												$(function () {
													$('#datepicker01').datepicker();
												});
												</script>
											</td>
											<td><input type="text" class="form-control input-sm"></td>
											<td><input type="text" class="form-control input-sm nameFilter"></td>
											<td><input type="text" class="form-control input-sm nameProdFilter"></td>
											<td><input type="text" class="form-control input-sm qtyFilter"></td>
											<td><input type="text" class="form-control input-sm hargaSatuanFilter"></td>
											<td><input type="text" class="form-control input-sm hargaTotalFilter"></td>
											<td width="120"><input type="text" class="form-control input-sm statusFilter"></td>
											<td><a class="btn btn-primary btn-xs filterButton">Filter</a></td>
										</tr>
									</thead>
									<tbody>
										@foreach($hasil as $key)
											<tr> 
												<td>{{$key->id}}</td>
												<td>{{$key->invoice}}</td>
												<td>{{$key->created_at}}</td>
												<td>{{$key->full_name}}</td>
												<td>{{$key->full_name}}</td>
												<td>{{$key->name}}</td>
												<td>{{$key->quantity}}</td>
												<td>{{$key->priceNow}}</td>
												<td>{{$key->total_price}}</td>
												<td>
													<select id="statusOrder" class="">
														@if($key->status == "Pending")
														<option value="Pending" selected="selected">Pending</option>
														<option value="On-process">On-process</option>
														<option value="Complete">Complete</option>
														@elseif($key->status == "On-process")
														<option value="Pending" >Pending</option>
														<option value="On-process" selected="selected">On-process</option>
														<option value="Complete">Complete</option>
														@elseif($key->status == "Complete")
														<option value="Pending" >Pending</option>
														<option value="On-process">On-process</option>
														<option value="Complete" selected="selected">Complete</option>
														@endif
														
													</select>
												
												</td>
												<td>
													<input type="hidden" value="{{$key->id}}" id="idOrder">
													<button class="btn btn-info btn-xs viewOrder" data-toggle="modal" data-target=".pop_up_view_order">View</button>
												</td>
											</tr> 
										@endforeach

									</tbody>
								</table>
								

							</div>

						</div>
					</div>
				</div>

				@include('includes.modals.alertYesNo')	
				@include('pages.admin.order.pop_up_view_order')
				<script>
					//filter button
					$('body').on('click','.filterButton',function(){
						$id = $('.idFilter').val();
						$invoice = $('.invoiceFilter').val();
						$purchasedOn = $('.purchasedOnFilter').val();
						$name = $('.nameFilter').val();
						$nameProd = $('.nameProdFilter').val();
						$qty = $('.qtyFilter').val();
						$hargaSatuan = $('.hargaSatuanFilter').val();
						$hargaTotal = $('.hargaTotalFilter').val();
						$status = $('.statusFilter').val();
						window.location = "{{URL::route('jeffry.getOrder')}}" + "?filtered=1&id="+$id+"&invoice="+$invoice+"&purchasedOn="+$purchasedOn+"&name="+$name+"&nameProd="+$nameProd+"&qty="+$qty+"&hargaSatuan="+$hargaSatuan+"&hargaTotal="+$hargaTotal+"&status="+$status;
					});
					//back button
					$('body').on('click','.backButton',function(){
						window.location = "{{URL::route('jeffry.getOrder')}}" ;
					});
					//change status
					$('body').on('change','#statusOrder',function(){
					$statusBaru = $('#statusOrder').val();
					$id = $('#idOrder').val();
					$.ajax({
							type: 'PUT',
							url: '{{URL::route('jeffry.putStatusOrder')}}',
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