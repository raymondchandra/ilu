@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			
				<div class="s_title_n_control">
					<h3 style="float: left;">
						CMS
					</h3>
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
					<button class="btn btn-success" style="float: right; margin-top: 20px;"  data-toggle="modal" data-target=".pop_up_add_tax">+ Add New Tax</button>
					<table class="table table-striped table-hover ">
						<thead class="table-bordered">
							<tr>
								<th class="table-bordered">
									<a href="javascript:void(0)">Name</a>
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
								
								<td width=""><a class="btn btn-primary btn-xs">Filter</a></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Header Title</td>
								
								<td>
									<button class="btn btn-warning btn-xs" data-toggle="modal" data-target=".pop_up_edit_company_info">Edit</button>
									<!-- Button trigger modal class ".alertYesNo" -->
								</td>
							</tr> 
							<tr>
								<td>SEO</td>
								
								<td>
									<button class="btn btn-warning btn-xs" data-toggle="modal" data-target=".pop_up_edit_seo">Edit</button>
									<!-- Button trigger modal class ".alertYesNo" -->
								</td>
							</tr> 
						</tbody>
					</table>
				</div>
				
			</div>
		</div>
	</div>
	
	@include('includes.modals.alertYesNo')	
	@include('pages.admin.cms.pop_up_edit_company_info')
	@include('pages.admin.cms.pop_up_edit_seo')

@stop