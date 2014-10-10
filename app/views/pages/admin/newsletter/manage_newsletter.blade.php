@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			
				<div class="s_title_n_control">
					<h3 style="float: left;">
						Manage Newsletter
					</h3>
					<button class="btn btn-success" style="float: right; margin-top: 20px;" data-toggle="modal" data-target=".pop_up_add_newsletter">+ Add New Tax</button>
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
								<th class="table-bordered">
									<a href="javascript:void(0)">Judul</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Subject</a>
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
								
								<td width=""><a class="btn btn-primary btn-xs">Filter</a></td>
							</tr>
						</thead>
						<tbody>
							<?php 
							for ($i=0; $i<=30; $i++) {
							  ?>
							<tr> 
								
								<td>Judul</td>
								<td>Subject</td>
								
								<td>
									<button class="btn btn-info btn-xs" data-toggle="modal" data-target=".pop_up_view_newsletter">View</button>
									<button class="btn btn-warning btn-xs" data-toggle="modal" data-target=".pop_up_edit_newsletter">Edit</button>
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
	@include('pages.admin.newsletter.pop_up_add_newsletter')
	@include('pages.admin.newsletter.pop_up_edit_newsletter')
	@include('pages.admin.newsletter.pop_up_view_newsletter')

@stop