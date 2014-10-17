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
							
							<ul class="pagination">
								<li><a href="#">&laquo;</a></li>
								<li><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li><a href="#">&raquo;</a></li>
							</ul>
							<table class="table table-striped table-hover ">
								<thead class="table-bordered">
									<tr>
										<th class="table-bordered"></th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Order No.</a>
											<a href="javascript:void(0)">
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Transaction No.</a>
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
											<td><input type="text" class="form-control input-sm"></td>
											<td width="120"><input type="text" class="form-control input-sm"></td>
											<td><a class="btn btn-primary btn-xs">Filter</a></td>
										</tr>
									</thead>
									<tbody>
										<?php 
										for ($i=0; $i<=30; $i++) {
											?>
											<tr> 
												<td><input type="checkbox"></td>
												<td>000000<?php echo($i); ?></td>
												<td>0004560<?php echo($i); ?></td>
												<td>Sep 28, 2014 11:54:09 PM</td>
												<td>Nama Pembeli</td>
												<td>Nama Penerima</td>
												<td>Tas Epic</td>
												<td>3</td>
												<td>IDR 300.000</td>
												<td>IDR 900.000</td>
												<td>Pending</td>
												<td>
													<button class="btn btn-info btn-xs" data-toggle="modal" data-target=".pop_up_view_order">View</button>
												</td>
											</tr> 
											<?php
										} 
										?>

									</tbody>
								</table>
								<ul class="pagination">
									<li><a href="#">&laquo;</a></li>
									<li><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#">&raquo;</a></li>
								</ul>

							</div>

						</div>
					</div>
				</div>

				@include('includes.modals.alertYesNo')	
				@include('pages.admin.order.pop_up_view_order')
				@stop