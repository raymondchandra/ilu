@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Set Up
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
								<li role="presentation" class="pull-right"><a href="#1" id='cms_bank' role="tab" data-toggle="tab" style="">Bank</a></li>
								<span class="clearfix "></span>
								<li role="presentation" class="pull-right"><a href="#2" id='cms_seo' role="tab" data-toggle="tab" style="">SEO</a></li>
								<span class="clearfix "></span>
								<!--<li role="presentation" class="pull-right"><a href="#3" role="tab" data-toggle="tab" style="">Informasi</a></li>
								<span class="clearfix "></span>
								<li role="presentation" class="pull-right"><a href="#4" id='cms_news' role="tab" data-toggle="tab" style="">News</a></li>
								<span class="clearfix "></span>
								<li role="presentation" class="pull-right"><a href="#5" id='cms_slideshow' role="tab" data-toggle="tab" style="">Slideshow</a></li>-->
							</ul>
						</div>
						<!-- Tab panes -->
						<div class="pull-left" style="width:76%; padding-left:20px; padding-right: 20px;border: 1px solid #676767 !important;">
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="0">
									@include('pages.admin.cms.edit_company_info')							
								</div>
								<div role="tabpanel" class="tab-pane fade" id="1">
									@include('pages.admin.cms.edit_bank_info')						
								</div>
								<div role="tabpanel" class="tab-pane fade" id="2">
									@include('pages.admin.cms.edit_seo')							
								</div>
								<!--<div role="tabpanel" class="tab-pane fade" id="3">
									{{-- @include('pages.admin.cms.edit_informasi')	--}}						
								</div>
								<div role="tabpanel" class="tab-pane fade" id="4">
									{{-- @include('pages.admin.cms.edit_news')	--}}						
								</div>
								<div role="tabpanel" class="tab-pane fade" id="5">
									{{-- @include('pages.admin.cms.edit_slideshow')	--}}						
								</div> -->
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
		
		$('body').on('click','#cms_news',function(){
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/news')}}",
				success: function(response){
					$msgs = response.messages;
					var div="";
					$($msgs).each(function(){
						//alert($(this)[0].id);
						div+="<tr>";
						div+="<td class='news_title'>";
						div+=$(this)[0].title;
						div+="</td>";
						div+="<td>";
						div+="<input type='hidden' value='"+$(this)[0].id+"'>";
						div+="<button type='button' class='btn btn-success view_detail' data-toggle='modal' data-target='.pop_up_edit_news'>Detail</button>";
						div+="<input type='hidden' value='"+$(this)[0].description+"'>";
						div+="</td>";
						div+="</tr>";
					});
					
					$('.f_news_table').html(div);
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			})
		});
		
		$('body').on('click','#cms_slideshow',function(){
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/slideshow')}}",
				success: function(response){
					if(response.code == 404){
						
					}
					else{
						var msgs = response.messages;
						var div = '';
						$(msgs).each(function(){
							div+="<tr>";
							div+="<td class='photo_preview'>";
							div+="<img src='"+$(this)[0].photo_path+"' class='preview_image' width='160' height='120' alt=''/>";
							div+="</td>";
							div+="<td>";
							div+="<button class='btn btn-warning edit_slideshow' data-toggle='modal' data-target='.pop_up_edit_image'>";
							div+="Edit";
							div+="</button>";
							div+="<input type='hidden' value='"+$(this)[0].id+"' />";
							div+="<button class='btn btn-danger delete_slideshow' data-toggle='modal' data-target='.pop_up_delete_image'>";
							div+="Delete";
							div+="</button>";
							div+="</td>";
							div+="</tr>";
						});
						$('.f_tbody_slideshow').html(div);
					}
					
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			});
		});
		
		$('body').on('click','#cms_bank',function(){
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/banks')}}",
				success: function(response){
					//alert(response);
					var tr_bank ='';
					$msg = response.messages;
					$.each($msg,function(){
						tr_bank +='<tr>';
						tr_bank +='		<td class="form-name">';
						tr_bank +='			<input type="text" value="'+$(this)[0].name+'" class="form-control" placeholder="Bank Name"  />';
						tr_bank +='		</td>';
						tr_bank +='		<td class="form-number">';
						tr_bank +='			<input type="text" value="'+$(this)[0].acc_number+'" class="form-control" placeholder="Account Number"  />';
						tr_bank +='		</td>';
						tr_bank +='		<td class="form-owner">';
						tr_bank +='			<input type="text"  value="'+$(this)[0].acc_owner+'" class="form-control" placeholder="Account Owner" />';
						tr_bank +='		</td>';
						tr_bank +='		<td>';
						tr_bank +='			<button type="button" class="btn btn-danger f_delete_bank">Delete</button>';
						tr_bank +='		</td>';
						tr_bank +="<input type='hidden' value="+$(this)[0].id+" class='id_bank'   />";
						tr_bank +='	</tr>';
					});
					$('.f_tbody_bank').html(tr_bank);
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			});
		});
		
		$('body').on('click','#cms_seo',function(){
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/seo')}}",
				success: function(response){
					$msgs = response.messages;
					var tr_seo="";
					$.each($msgs,function(){
						//alert($(this)[0].id);
						tr_seo += '<tr>';
						tr_seo +='	<td>';
						tr_seo +=''+ $(this)[0].name +'';
						tr_seo +='	</td>';
						tr_seo +='	<td>';
						tr_seo +='		<span class="meta">'+ $(this)[0].content +'</span>';
						tr_seo +='		<input type="text" class="form-control hidden meta">';
						tr_seo +='	</td>';
						tr_seo +='	<td>';
						tr_seo +='		<span class="meta">'+ $(this)[0].key +'</span>';
						tr_seo +='		<input type="text" class="form-control hidden meta">';
						tr_seo +='	</td>';
						tr_seo +='</tr>';
					});
					
					$('.f_tbody_table').html(tr_seo);
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			});
		});
	</script>

	@include('includes.modals.alertYesNo')	

	@stop