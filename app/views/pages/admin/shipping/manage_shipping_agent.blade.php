@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Manage Shipping Agent | Dari Kota X
				</h3>
				<a href="{{ URL::to('test/manage_shipping') }}" class="btn btn-info" style="float: right; margin-top: 20px;margin-left: 10px;" >Manage Shipping</a>
				<a href="{{ URL::to('test/manage_shipping_agent') }}" class="btn btn-default" style="float: right; margin-top: 20px;margin-left: 10px;" >Manage Shipping Agent</a>
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
				<button class="btn btn-success" style="float: right; margin-top: 20px;"  data-toggle="modal" data-target=".pop_up_add_shipping_agent">+ Add New Kurir</button>

				<table class="table table-striped table-hover ">
					<thead class="table-bordered">
						<tr>
							<th class="table-bordered">
								<a href="javascript:void(0)">ID Kurir</a>
								<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered" width="120">
								<a href="javascript:void(0)">Nama Kurir</a>
								<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered">
								<a href="javascript:void(0)">Destinasi</a>
								<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered">
								<a href="javascript:void(0)">Price</a>
								<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered">

							</th>
						</thead>
						<thead>
							<tr>
								<td><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								
								<td width=""><a class="btn btn-primary btn-xs">Filter</a></td>
							</tr>
						</thead>
						<tbody>
							<?php 
							for ($i=0; $i<=30; $i++) {
								?>
								<tr> 

									<td>987JHJ8969</td>
									<td>JNE</td>
									<td>Jl. Bandung Barat Banget No. 99</td>
									<td>Ashshiddiq Wangsaatmadja</td>

									<td>
										<button class="btn btn-info btn-xs" data-toggle="modal" data-target=".pop_up_view_shipping_agent">View</button>
										<!-- Button trigger modal class ".alertYesNo" -->
										<button class="btn btn-danger btn-xs" data-toggle="modal" data-target=".alertYesNo">Delete</button>
									</td>
								</tr> 
								<?php
							} 
							?>
							
						</tbody>
					</table>
				</div>
				
			</div>
		</div>
	</div>
	
	@include('includes.modals.alertYesNo')
	@include('pages.admin.shipping.pop_up_view_shipping_agent')
	@include('pages.admin.shipping.pop_up_add_shipping_agent')

	@stop