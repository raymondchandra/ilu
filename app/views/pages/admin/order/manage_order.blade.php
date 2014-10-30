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
							
							{{$hasil->links()}}
							<table class="table table-striped table-hover ">
								<thead class="table-bordered">
									<tr>
										<th class="table-bordered">
											<a href="javascript:void(0)">Order No.</a>
											<a href="javascript:void(0)">
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Invoice</a>
											<a href="javascript:void(0)">
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Purchased On</a>
											<a href="javascript:void(0)">
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
											<a href="javascript:void(0)">
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Product Name</a>
											<a href="javascript:void(0)">
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Qty</a>
											<a href="javascript:void(0)">
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Harga Satuan</a>
											<a href="javascript:void(0)">
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Harga Total</a>
											<a href="javascript:void(0)">
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Status</a>
											<a href="javascript:void(0)">
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">Action
										</th>
									</tr>
								</thead>
								<thead>
									<tr>
										<td></th>
											<td width="125"><input type="text" class="form-control input-sm"></td>
											<td><input type="text" class="form-control input-sm"></td>
											<td width="200">
												<input type="text" id='datepicker00' class="form-control input-sm" style="width: 48%; display: inline-block;"/>
												<input type="text" id='datepicker01' class="form-control input-sm" style="width: 48%; display: inline-block;"/>
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
											<td><input type="text" class="form-control input-sm"></td>
											<td><input type="text" class="form-control input-sm"></td>
											<td><input type="text" class="form-control input-sm"></td>
											<td><input type="text" class="form-control input-sm"></td>
											<td width="120"><input type="text" class="form-control input-sm"></td>
											<td><a class="btn btn-primary btn-xs">Filter</a></td>
										</tr>
									</thead>
									<tbody>
										@foreach($hasil as $key)
											<tr> 
												<td>{{$key->id}}</td>
												<td>{{$key->transaction->invoice}}</td>
												<td>{{$key->created_at}}</td>
												<td>{{$key->acc_name}}</td>
												<td>{{$key->acc_name}}</td>
												<td>{{$key->productName}}</td>
												<td>{{$key->quantity}}</td>
												<td>{{$key->priceNow}}</td>
												<td>{{$key->transaction->total_price}}</td>
												<td>
													<select id="" class="">
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
													<button class="btn btn-info btn-xs" data-toggle="modal" data-target=".pop_up_view_order">View</button>
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
				@stop