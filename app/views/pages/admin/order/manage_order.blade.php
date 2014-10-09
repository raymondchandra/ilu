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
												<a href="javascript:void(0)">Order #</a>
												<a href="javascript:void(0)">
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
												</a>
											</th>
											<th class="table-bordered">
												<a href="javascript:void(0)">Transaction ID</a>
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
												<a href="javascript:void(0)">Grand Total (Base)</a>
												<a href="javascript:void(0)">
												<span class="glyphicon glyphicon-sort" style="float: right;"></span>
												</a>
											</th>
											<th class="table-bordered">
												<a href="javascript:void(0)">Grand Total (Final)</a>
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
											<td>www.toko.com</td>
											<td>Sep 28, 2014 11:54:09 PM</td>
											<td>Nama Pembeli</td>
											<td>Nama Pembeli</td>
											<td>Rp 3.000.000</td>
											<td>Rp 3.050.000</td>
											<td>Pending</td>
											<td><a class="btn btn-warning btn-xs">View</a></td>
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
			@stop