@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Content Management System
				</h3>
			</div>
			<span class="clearfix"></span>
			<hr></hr>

			<div>
				<!-- <ul class="pagination">
					<li><a href="#">&laquo;</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">&raquo;</a></li>
				</ul> -->
				<!-- <button class="btn btn-success" style="float: right; margin-top: 20px;"  data-toggle="modal" data-target=".pop_up_add_tax">+ Add New Tax</button> -->

				<div class="row">
					

					<div class="col-sm-12">
						<div class="pull-left" style="width: 20%;">
							<style>
							.nav-tabs > li {
								width: 100%;
							}
							.nav-tabs > li > a {
								border-top: 1px solid #ddd;
								border-bottom: 1px solid #ddd;
								border-left: 1px solid #ddd;
								border-right: 1px solid #ddd;
								border-radius: 4px 4px 4px 4px;
								background-color: #ddd;
							}

							.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus{
								border-top: 1px solid #ddd;
								border-bottom: 1px solid #ddd;
								border-left: 1px solid #ddd;
								border-right: 1px solid #ddd;
								border-radius: 4px 4px 4px 4px;
								background-color: #fff;
							}
							</style>
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist" style="border: 0px;">
								<li role="presentation" class="active pull-right"><a href="#0" role="tab" data-toggle="tab" style="">Company Info</a></li>
								<span class="clearfix "></span>
								<li role="presentation" class="pull-right"><a href="#1" role="tab" data-toggle="tab" style="">SEO</a></li>
								<span class="clearfix "></span>
								<li role="presentation" class="pull-right"><a href="#2" role="tab" data-toggle="tab" style="">Informasi</a></li>
								<span class="clearfix "></span>
								<li role="presentation" class="pull-right"><a href="#3" role="tab" data-toggle="tab" style="">News</a></li>
							</ul>
						</div>
						<!-- Tab panes -->
						<div class="pull-left" style="width:76%; padding-left:20px; padding-right: 20px;border: 1px solid #676767 !important;">
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="0">
									@include('pages.admin.cms.pop_up_edit_company_info')							
								</div>
								<div role="tabpanel" class="tab-pane fade" id="1">
									@include('pages.admin.cms.pop_up_edit_seo')							
								</div>
								<div role="tabpanel" class="tab-pane fade" id="2">
									@include('pages.admin.cms.pop_up_edit_informasi')							
								</div>
								<div role="tabpanel" class="tab-pane fade" id="3">
									@include('pages.admin.cms.pop_up_edit_news')							
								</div>
							</div>
						</div>
					</div>
				</div>




				<!-- <table class="table table-striped table-hover ">
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
								</td>
							</tr> 
							<tr>
								<td>SEO</td>

								<td>
									<button class="btn btn-warning btn-xs" data-toggle="modal" data-target=".pop_up_edit_seo">Edit</button>
								</td>
							</tr> 
						</tbody>
					</table> -->
				</div>

			</div>
		</div>
	</div>
	<script>
		//var asd = $()
		$('body').on('click','[data-dismiss="modal"]', function(){
			$('.modal-backdrop').removeClass('in');
			setTimeout(function() {
			     $('.modal-backdrop').fadeOut( 300, function(){});
			}, 500);
		});

		$('body').on('click','[aria-hidden="true"]', function(){
			$('.modal-backdrop').removeClass('in');
			setTimeout(function() {
			     $('.modal-backdrop').fadeOut( 300, function(){});
			}, 500);
		});
	</script>

	@include('includes.modals.alertYesNo')	

	@stop