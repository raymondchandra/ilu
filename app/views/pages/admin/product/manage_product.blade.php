@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	

<script>
	//global variabel buat add product	
	var arr_attr = new Array();
	var idx_attr_row = 1;
	
	var arr_photos = new Array();
	var idx_photos_row = 1;
		
	var attributes_id_input = new Array();
	var attributes_value_input = new Array();
	var prices_input = new Array();
	
	var photos_input = new Array();
	
	var array_input_other_photos = new Array();
	var temp_name_other_photos = "other_photos_";
	var temp_idx_other_photos = 1;	

	var attributes_id_input = new Array();
	var attributes_value_input = new Array();
	var prices_input = new Array();		
		
	//global variabel buat edit product
	var arr_edit_price = "";
	
	//global variabel buat edit photo
	var edit_main_photo = "";
	var arr_edit_other_photo = "";
	
	var edit_arr_photos = new Array();
	var edit_idx_photos_row = 1;
	
	var edit_array_input_other_photos = new Array();
	var edit_temp_name_other_photos = "edit_other_photos_";
	var edit_temp_idx_other_photos = 1;	
	
	var edit_arr_id = new Array();
	var edit_arr_files = new Array();
	
	var edit_arr_delete = new Array();
</script>

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
					@if($products == null)
						@if($filtered == 0)
							<button href="" class="btn btn-success refreshAdd" style="float: right; margin-top: 20px;" data-toggle="modal" data-target=".pop_up_add_product">+ Add Product</button>
							<p>No Products</p>
						@else
							<button class="btn btn-success backButton" style="float: right; margin-top: 20px; margin-bottom: 25px;">Back</button>
							<p>Search not match anything</p>
							<table class="table table-striped table-hover ">
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
							</table>	
						@endif
					@else					
						@if($filtered == 0)
							{{$products->appends(array('sortBy' => $sortBy, 'order' => $sortType, 'filtered' => $filtered))->links()}}
							<button href="" class="btn btn-success refreshAdd" style="float: right; margin-top: 20px;" data-toggle="modal" data-target=".pop_up_add_product">+ Add Product</button>
						@else
							<button class="btn btn-success backButton" style="float: right; margin-top: 20px; margin-bottom: 25px;">Back</button>
						@endif
						<table class="table table-striped table-hover ">
							<thead class="table-bordered">
								<tr>
									<th class="table-bordered">
										<a href="javascript:void(0)">ID</a>
										@if($filtered == 0)
											@if($sortBy == "id")
												@if($sortType == "asc")
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'id', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
												@else
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'id', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
												@endif
											@else
												<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'id', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
											@endif	
										@else
											@if($sortBy == "id")
												@if($sortType == "asc")
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'id', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
												@else
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'id', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
												@endif
											@else
												<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'id', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
											@endif	
										@endif		
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>										
										</a>
									</th>
									<th class="table-bordered">
										<a href="javascript:void(0)">Product ID</a>
										@if($filtered == 0)
											@if($sortBy == "product_no")
												@if($sortType == "asc")
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'product_no', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
												@else
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'product_no', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
												@endif
											@else
												<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'product_no', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
											@endif	
										@else
											@if($sortBy == "product_no")
												@if($sortType == "asc")
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'product_no', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
												@else
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'product_no', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
												@endif
											@else
												<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'product_no', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
											@endif	
										@endif		
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>										
										</a>
									</th>
									<th class="table-bordered">
										<a href="javascript:void(0)">Name</a>
										@if($filtered == 0)
											@if($sortBy == "name")
												@if($sortType == "asc")
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'name', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
												@else
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
												@endif
											@else
												<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
											@endif	
										@else
											@if($sortBy == "name")
												@if($sortType == "asc")
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'name', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
												@else
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
												@endif
											@else
												<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
											@endif	
										@endif		
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>										
										</a>
									</th>
									<th class="table-bordered">
										<a href="javascript:void(0)">Category Name</a>
										@if($filtered == 0)
											@if($sortBy == "category_name")
												@if($sortType == "asc")
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'category_name', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
												@else
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'category_name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
												@endif
											@else
												<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'category_name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
											@endif	
										@else
											@if($sortBy == "category_name")
												@if($sortType == "asc")
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'category_name', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
												@else
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'category_name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
												@endif
											@else
												<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'category_name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
											@endif	
										@endif		
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>										
										</a>
									</th>
									<th class="table-bordered">
										<a href="javascript:void(0)">Promotion ID</a>
										@if($filtered == 0)
											@if($sortBy == "promotion_id")
												@if($sortType == "asc")
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'promotion_id', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
												@else
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'promotion_id', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
												@endif
											@else
												<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'promotion_id', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
											@endif	
										@else
											@if($sortBy == "promotion_id")
												@if($sortType == "asc")
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'promotion_id', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
												@else
													<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'promotion_id', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
												@endif
											@else
												<a href="{{action('ProductsManagementController@view_admin_product', array('sortBy' => 'promotion_id', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'product_no' => $product_no, 'name' => $name, 'category_name' => $category_name, 'promotion_id' => $promotion_id))}}">
											@endif	
										@endif		
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
									<td width="125"><input type="text" class="form-control input-sm filterId"></td>
									<td><input type="text" class="form-control input-sm filterProductNo"></td>									
									<td><input type="text" class="form-control input-sm filterName"></td>
									<td><input type="text" class="form-control input-sm filterCategoryName"></td>
									<td><input type="text" class="form-control input-sm filterPromotionId"></td>
									<td><a class="btn btn-primary btn-xs filterButton">Filter</a></td>
								</tr>
							</thead>
							<tbody>
								@foreach($products as $product)
									<tr> 
										<td id="id_{{$product->id}}">{{$product->id}}</td>
										<td id="product_no_{{$product->product_no}}">{{$product->product_no}}</td>
										<td id="name_{{$product->name}}">{{$product->name}}</td>
										<td id="category_name_{{$product->category_name}}">{{$product->category_name}}</td>
										<td id="promotion_id_{{$product->promotion_id}}">{{$product->promotion_id}}</td>
										<td>
											<input type='hidden' value='{{$product->id}}'>
											<a class="btn btn-warning btn-xs detailButtonInfo" data-toggle="modal" data-target=".pop_up_edit_product">Edit Info</a>
											<input type='hidden' value='{{$product->id}}'>
											<a class="btn btn-warning btn-xs detailButtonGallery" data-toggle="modal" data-target=".pop_up_edit_product_gallery">Edit Gallery</a>											
											<input type='hidden' value='{{$product->id}}'>
											<a class="btn btn-danger btn-xs deleteButton" data-toggle="modal" data-target=".alertYesNo">Delete</a>
										</td>
									</tr> 
								@endforeach
							</tbody>
						</table>
					@endif
										
					
				</div>				
			</div>
		</div>
	</div>
	
	@include('pages.admin.product.alertYesNo')
	@include('pages.admin.product.pop_up_edit_product_gallery')
	@include('pages.admin.product.pop_up_edit_product')
	@include('pages.admin.product.pop_up_add_product')
	
	<script>
		$('body').on('click', '.detailButtonInfo', function(){
			$id = $(this).prev().val();								
				//set value di pop up edit
				$.ajax({
					type: 'GET',
					url: "{{URL('admin/product')}}/"+$id,
					success: function(response){
						result = JSON.parse(response);
						if(result.code==200){
							$message = result.messages;
							//set value di pop up edit						
							$('#edit_id').text($message.id);
							$('#edit_product_no').text($message.product_no);
							$('#edit_name').text($message.nama);
							$('#edit_description').text($message.description);
							$('#edit_category_id').text($message.category_name);						
								$('#edit_category_id_input').val($message.category_id);
							$('#edit_promotion_id').text($message.promotion_name);						
								$('#edit_promotion_id_input').val($message.promotion_id);
								
							arr_edit_price = $message.prices;	
							
							if(arr_edit_price != "")
							{
								var text = '';	
								for($i=0; $i<($message.prices).length; $i++)
								{
									text += '<div class="form-group ">';
										text += '<div class="col-sm-3 div_attr_name">';
											text += '<p class="form-control-static custom_attr_n">'+$message.prices[$i]['attr_name']+'</p>';												
											text += ' <select class="form-control hidden custom_attr_name" value="'+$message.prices[$i]['attr_id']+'"><?php foreach($list_attribute as $key => $value){ ?><option value="<?php echo $key;?>"><?php echo $value; ?></option><?php } ?></select> ';											
										text += '</div>';
										
										text += '<div class="col-sm-3 div_attr_value">';
											text += '<p class="form-control-static custom_attr_v">'+$message.prices[$i]['attr_value']+'</p>';
											text += '<input class="form-control hidden custom_attr_value" value="'+$message.prices[$i]['attr_value']+'"/>';
										text += '</div>';
										
										text += '<div class="col-sm-3 div_price_value">';
											text += '<p class="form-control-static custom_price_v">'+$message.prices[$i]['amount']+'</p>';
											text += '<input class="form-control hidden custom_price_value" value="'+$message.prices[$i]['amount']+'"/>';
										text += '</div>';
										
										text += '<div class="col-sm-3">';
											text += '<button type="button" class="btn btn-warning custom_attr_edit">Edit</button>';
											text += '<button type="button" class="btn btn-success hidden custom_attr_setter">Set</button>';
											text += '<input type="hidden" value="'+$message.prices[$i]['id']+'" />';
										text += '</div>';
									text += '</div>';
								}																																	
								$('.div_edit_price').html(text);
							}
							else
							{
								$('.div_edit_price').html("");
							}
						}					
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(errorThrown);
					}
				},'json');
		});
		
		$('body').on('click', '.detailButtonGallery', function(){
			$id = $(this).prev().val();
			
				//refresh semua variable yang dipake buat editGallery
				//global variabel buat edit photo
				edit_main_photo = "";
				arr_edit_other_photo = "";
				
				edit_arr_photos = new Array();
				edit_idx_photos_row = 1;
				
				edit_array_input_other_photos = new Array();
				edit_temp_name_other_photos = "edit_other_photos_";
				edit_temp_idx_other_photos = 1;	
								
				edit_arr_id = new Array();
				edit_arr_files = new Array();
				
				edit_arr_delete = new Array();					
				
				//set value di pop up edit
				$.ajax({
					type: 'GET',
					url: "{{URL('admin/product')}}/"+$id,
					success: function(response){
						result = JSON.parse(response);
						if(result.code==200){
							$message = result.messages;														
							// alert(JSON.stringify($message.main_photo_id));													
							//set value di pop up edit		
							if($message.main_photo != "")
							{
								$('#edit_show_main_photo').attr('src', '../'+$message.main_photo );
							}
							else
							{
								$('#edit_show_main_photo').attr('src', '');
							}
							
							$('#edit_main_photo_id').val($message.main_photo_id);
							
							arr_edit_other_photo = $message.other_photos;
							
							if(arr_edit_other_photo != "")
							{
								var text = '';	
								for($i=0; $i<($message.other_photos).length; $i++)
								{
									edit_arr_photos[edit_arr_photos.length] = edit_idx_photos_row;
									
									text +=' <tr>';			
										if($message.other_photos[$i]['photo_path'] != '')
										{
											text +=' <td><img src="../'+$message.other_photos[$i]['photo_path']+'" width="150" height="150" class="pull-right showImage'+edit_idx_photos_row+'" /></td>';
										}
										else
										{
											text +=' <td><img src="" alt="no photos" width="150" height="150" class="pull-right showImage'+edit_idx_photos_row+'" /></td>';
										}										
										text +=' <td><input type="hidden" value="'+edit_idx_photos_row+'" /><input type="file" class="edit_other_photos_input'+edit_idx_photos_row+' edit_other_photos_change" accept="image/*" /></td>';						
										text +=' <td><input type="hidden" value="'+$message.other_photos[$i]['id']+'" /><input type="hidden" value="'+edit_idx_photos_row+'"/><button type="button" class="btn btn-danger f_remove_edit_photo"><span class="glyphicon glyphicon-remove"></span></button></td>';
									text +='</tr>';																
									
									edit_idx_photos_row++;
								}					
								$('#product_photo_edit').html(text);
								
								alert(edit_arr_photos);
							}
							else
							{
								$('#product_photo_edit').html('');
							}
							
							// $('#edit_id').text($message.id);
							// $('#edit_product_no').text($message.product_no);
							// $('#edit_name').text($message.nama);
							// $('#edit_description').text($message.description);
							// $('#edit_category_id').text($message.category_name);						
								// $('#edit_category_id_input').val($message.category_id);
							// $('#edit_promotion_id').text($message.promotion_name);						
								// $('#edit_promotion_id_input').val($message.promotion_id);
								
							// arr_edit_price = $message.prices;	
							
							// if(arr_edit_price != "")
							// {
								// var text = '';	
								// for($i=0; $i<($message.prices).length; $i++)
								// {
									// text += '<div class="form-group ">';
										// text += '<div class="col-sm-3 div_attr_name">';
											// text += '<p class="form-control-static custom_attr_n">'+$message.prices[$i]['attr_name']+'</p>';												
											// text += ' <select class="form-control hidden custom_attr_name" value="'+$message.prices[$i]['attr_id']+'"><?php foreach($list_attribute as $key => $value){ ?><option value="<?php echo $key;?>"><?php echo $value; ?></option><?php } ?></select> ';											
										// text += '</div>';
										
										// text += '<div class="col-sm-3 div_attr_value">';
											// text += '<p class="form-control-static custom_attr_v">'+$message.prices[$i]['attr_value']+'</p>';
											// text += '<input class="form-control hidden custom_attr_value" value="'+$message.prices[$i]['attr_value']+'"/>';
										// text += '</div>';
										
										// text += '<div class="col-sm-3 div_price_value">';
											// text += '<p class="form-control-static custom_price_v">'+$message.prices[$i]['amount']+'</p>';
											// text += '<input class="form-control hidden custom_price_value" value="'+$message.prices[$i]['amount']+'"/>';
										// text += '</div>';
										
										// text += '<div class="col-sm-3">';
											// text += '<button type="button" class="btn btn-warning custom_attr_edit">Edit</button>';
											// text += '<button type="button" class="btn btn-success hidden custom_attr_setter">Set</button>';
											// text += '<input type="hidden" value="'+$message.prices[$i]['id']+'" />';
										// text += '</div>';
									// text += '</div>';
								// }																																	
								// $('.div_edit_price').html(text);
							// }
							// else
							// {
								// $('.div_edit_price').html("");
							// }
						}					
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(errorThrown);
					}
				},'json');
		});
		
		$('body').on('click', '.deleteButton', function(){
			$id = $(this).prev().val();					
			// alert($id);
		});
		
		$('body').on('click', '.filterButton', function(){
			$id = $('.filterId').val();
			$product_no = $('.filterProductNo').val();
			$name = $('.filterName').val();
			$category_name = $('.filterCategoryName').val();
			$promotion_id = $('.filterPromotionId').val();
			window.location = "{{URL::route('viewProductsManagement')}}"+"?filtered=1&id="+$id+"&product_no="+$product_no+"&name="+$name+"&category_name="+$category_name+"&promotion_id="+$promotion_id;
		});
		
		$('body').on('click','.backButton', function(){
			window.location = "{{URL::route('viewProductsManagement')}}";
		});
		
		$('body').on('click', '.refreshAdd', function(){
			//refresh semua variable yang dipake buat addProduct
			arr_attr = new Array();
			idx_attr_row = 1;
			
			arr_photos = new Array();
			idx_photos_row = 1;
				
			attributes_id_input = new Array();
			attributes_value_input = new Array();
			prices_input = new Array();
			
			photos_input = new Array();
			
			array_input_other_photos = new Array();
			temp_name_other_photos = "other_photos_";
			temp_idx_other_photos = 1;	

			attributes_id_input = new Array();
			attributes_value_input = new Array();
			prices_input = new Array();					
			//end
			
			//refresh semua field di pop up add
			$('#new_name_input').val('');
			$('#new_product_no_input').val('');			
			$('#new_description_input').val('');
			$('#new_category_id_input').val('1');
			$('#new_promotion_id_input').val('-1');
			$('#show_main_photo').attr('src', '');
			$('.main_photo_input').val('');
			//end
		});			
		
		
		/*
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
		*/
	</script>
@stop