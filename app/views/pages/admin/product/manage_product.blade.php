@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			
				<div class="s_title_n_control">
					<h3 style="float: left;">
						Manage Product
					</h3>
				</div>
				<span class="clearfix"></span>
				<hr></hr>
				<div>
					<div id='navigator'>
					{{$datas->links()}}
					</div>
					<!--<ul class="pagination">
					  <li><a href="#">&laquo;</a></li>
					  <li><a href="#">1</a></li>
					  <li><a href="#">2</a></li>
					  <li><a href="#">3</a></li>
					  <li><a href="#">4</a></li>
					  <li><a href="#">5</a></li>
					  <li><a href="#">&raquo;</a></li>
					</ul>-->
					<button href="" class="btn btn-success" style="float: right; margin-top: 20px;" data-toggle="modal" data-target=".pop_up_add_product">+ Add Product</button>
					<table class="table table-striped table-hover table-condensed table-bordered">
						<thead class="table-bordered">
							<tr>
								<th class="table-bordered">
									<a href="javascript:void(0)">ID</a>
									<a href="javascript:void(0)" id='sort_id' value='asc'>
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Product ID</a>
									<a href="javascript:void(0)" id='sort_product_id' value='asc'>
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Name</a>
									<a href="javascript:void(0)" id='sort_name' value='asc'>
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Category Name</a>
									<a href="javascript:void(0)" id='sort_category' value='asc'>
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Promotion ID</a>
									<a href="javascript:void(0)" id='sort_promotion' value='asc'>
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
								<td width="125"><input type="text" class="form-control input-sm" id='filter_id'></td>
								<td><input type="text" class="form-control input-sm" id='filter_product_id'></td>
								
								<td><input type="text" class="form-control input-sm" id='filter_name'></td>
								<td><input type="text" class="form-control input-sm" id='filter_category'></td>
								<td><input type="text" class="form-control input-sm" id='filter_promotion'></td>
								<td><a class="btn btn-primary btn-xs" id='button_filter'>Filter</a></td>
							</tr>
						</thead>
						<tbody id='product_list'>
						@foreach($datas as $product)
							<tr> 
								<td>1</td>
								<td>{{$product->product_no}}</td>
								<td>{{$product->name}}</td>
								<td>{{$product->category_name}}</td>
								<td>{{$product->promotion_id}}</td>
								<td>
									<input type='hidden' class='id_produk' value='{{$product->id}}'>
									<a class="btn btn-warning btn-xs detail-product" data-toggle="modal" data-target=".pop_up_edit_product">Edit Info</a>
									<a class="btn btn-warning btn-xs" data-toggle="modal" data-target=".pop_up_edit_product_gallery">Edit Gallery</a>
									<!-- Button trigger modal class ".alertYesNo" -->
									<a class="btn btn-danger btn-xs" data-toggle="modal" data-target=".alertYesNo">Delete</a>
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
	@include('pages.admin.product.pop_up_edit_product_gallery')
	@include('pages.admin.product.pop_up_edit_product')
	@include('pages.admin.product.pop_up_add_product')
	
	<script>
		$('body').on('click','.detail-product',function(){
			$id = $(this).siblings('.id_produk').val();
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/product')}}/"+$id,
				success: function(response){
					result = JSON.parse(response);
					if(result.code==200){
						$message = result.messages;
						$('.no_product').text($message.product_no);
						$('.product_name').text($message.name);
						$('#product_description').text($message.description);
						$('#product_category').text($message.category_name);
						
						if($message.promotion_id != ""){
							$('#promotion_id').text($message.promotion_id);
						}
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			},'json');
		});
		
		$('body').on('click','#button_filter',function(){
			filter('id','asc');
		});
		
		$('body').on('click','#sort_id',function(){
			filter('id',$(this).val());
			if($(this).val() == 'asc'){
				$(this).val('desc');
			}
			else{
				$(this).val('asc');
			}
		});
		
		$('body').on('click','#sort_product_id',function(){
			filter('product_no',$(this).val());
			if($(this).val() == 'asc'){
				$(this).val('desc');
			}
			else{
				$(this).val('asc');
			}
		});
		
		$('body').on('click','#sort_name',function(){
			filter('name',$(this).val());
			if($(this).val() == 'asc'){
				$(this).val('desc');
			}
			else{
				$(this).val('asc');
			}
		});
		
		function filter($sort,$asc){
			$filter_id =$('#filter_id').val();
			$filter_product_id = $('#filter_product_id').val();
			$filter_name = $('#filter_name').val();
			$filter_category = $('#filter_category').val();
			$filter_promotion =$('#filter_promotion').val();
			
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/filter')}}",
				data:{
					'id' : $filter_id,
					'product_id' : $filter_product_id,
					'name' : $filter_name,
					'category' : $filter_category,
					'promotion' : $filter_promotion,
					'sort' : $sort,
					'asc' : $asc
				},
				success: function(responses){
					var div="";
					var obj = jQuery.parseJSON(responses);
					var response = obj.datas;
					$(response).each(function() {
						div+= "<tr>";
						div+="<td>1</td>";
						div+="<td>"+$(this)[0].product_no+"</td>";
						div+="<td>"+$(this)[0].name+"</td>";
						div+="<td>"+$(this)[0].category_name+"</td>";
						div+="<td>"+$(this)[0].promotion_id+"</td>";
						div+="<td>";
						div+="<input type='hidden' class='id_produk' value='"+$(this)[0].id+"'>";
						div+="<a class='btn btn-warning btn-xs detail-product' data-toggle='modal' data-target='.pop_up_edit_product'>Edit Info</a>";
						div+="<a class='btn btn-warning btn-xs' data-toggle='modal' data-target='.pop_up_edit_product_gallery'>Edit Gallery</a>";
						div+="<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='.alertYesNo'>Delete</a>";
						div+="</td>";
						div+="</tr>";
					});
					$('#product_list').html(div);
					$('#navigator').html(obj.links);
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			},'json');
		}
		
	</script>
@stop