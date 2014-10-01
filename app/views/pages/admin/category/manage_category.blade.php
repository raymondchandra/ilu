@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
	<div class="container-fluid">
		<div class="row">
			<div class="g-lg-12">
			
				<div class="s_title_n_control">
					<h3 style="float: left;">
						Manage Category
					</h3>
					<a href="add_category" class="btn btn-success" style="float: right; margin-top: 20px;">+ Add Category</a>
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
								ID
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Nama</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
								Edit
								</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<td width="40"></th>
								<td width="125"><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								
								<td width="120"><a class="btn btn-primary btn-xs">Filter</a></td>
							</tr>
						</thead>
						<tbody>
							<?php 
							for ($i=0; $i<=30; $i++) {
							  ?>
							<tr> 
								<td><input type="checkbox"></td>
								<td><?php echo($i); ?></td>
								<td>Barang bagus</td>
								
								<td>
									<a class="btn btn-warning btn-xs">Edit</a>
									<!-- Button trigger modal class ".alertYesNo" -->
									<a class="btn btn-danger btn-xs" data-toggle="modal" data-target=".alertYesNo">Delete</a>
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

@stop