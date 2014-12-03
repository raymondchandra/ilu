<div class="modal fade pop_up_edit_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Product Info</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">							
							
							<div class="form-group" id="nama_promosi">
								<label class="col-sm-4 control-label">ID</label>
								<div class="col-sm-4">
									<p id="edit_id" class="form-control-static">0000000</p>									
								</div>	
								<button type="button" id="f_edit_add_new_attr" class="btn btn-success pull-right">
									Add New Attribute
								</button>							
								<script>
									$('body').on('click','#f_edit_add_new_attr',function(){	
										edit_arr_prices[edit_arr_prices.length] = edit_idx_prices_row;
										alert(edit_arr_prices);
										
										var new_line = '<div class="form-group">'
										new_line+='	<div class="col-sm-3 ">';							
										new_line+=' <select class="form-control edit_new_attr_id_input'+edit_idx_prices_row+'"><?php foreach($list_attribute as $key => $value){ ?><option value="<?php echo $key; ?>"><?php echo $value; ?></option><?php } ?></select> ';
										new_line+='	</div>';
										new_line+='	<div class="col-sm-4">';
										new_line+='		<input type="text" class="form-control edit_new_attr_value_input'+edit_idx_prices_row+'" placeholder="value"/>';
										new_line+='	</div>';
										new_line+='	<div class="col-sm-3">';
										new_line+='		<input type="text" onkeypress="return isNumberKey(event)" class="form-control edit_new_price_input'+edit_idx_prices_row+'" placeholder="harga (optional)"/>';
										new_line+='	</div>';
										new_line+='	<div class="col-sm-2">';
										new_line += '<input type="hidden" value="" />';
										new_line+='		<input type="hidden" value="'+edit_idx_prices_row+'"/><button type="button" class="btn btn-danger f_delete_row_attr">X</button>';
										new_line+='	</div>';
										new_line+='</div>';
										// $('#f_add_product_container').append(new_line);
										$('.div_edit_price').append(new_line);
										
										edit_idx_prices_row++;
									});
									
									$( 'body' ).on( "click",'.f_delete_row_attr', function() {					
										//delete from arr_attr
										$id_del_attr = $(this).prev().val();
										for($i = 0; $i < edit_arr_prices.length; $i++)
										{
											if(edit_arr_prices[$i] == $id_del_attr)
											{
												edit_arr_prices[$i] = -1;
											}
										}
										
										$(this).parent().parent().hide(300, function(){ 
											$(this).remove(); 
										});
										
										//delete langsung prices
										$delete_id_price = $(this).prev().prev().val();									
										$data = {'id' : $delete_id_price};
										var json_data = JSON.stringify($data);										
										if($delete_id_price != "")
										{
											// alert($delete_id_price);
											
											//panggil ajax delete price
											$.ajax({
												type: 'DELETE',
												url: "{{URL('admin/product/deletePrice')}}",
												data: {'json_data' : json_data},
												success: function(response){
													// alert(response);				
													result = JSON.parse(response);
													if(result.code==204)
													{
														alert(result.status);
													}
													else
													{
														alert(result.status);
														alert(result.messages);
													}
												},
												error: function(jqXHR, textStatus, errorThrown){
													alert(errorThrown);
												}
											
											},'json');										
										}
										
										alert(edit_arr_prices);
									});							
								</script>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Product No.</label>
								<div class="col-sm-5">
									<p id="edit_product_no" class="form-control-static no_product">00045383945</p>
									<input id="edit_product_no_input" class="form-control hidden"/>
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="product_no_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="product_no_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#product_no_editor', function() {
										$('#edit_product_no_input').val($('#edit_product_no').text());
										$('#edit_product_no_input').removeClass('hidden');
										$('#product_no_setter').removeClass('hidden');
										$('#edit_product_no').addClass('hidden');
										$('#product_no_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#product_no_setter', function() {
										$new_product_no = $('#edit_product_no_input').val();										
										$data = {
											'id' : $id,
											'new_product_no' : $new_product_no
										};
										var json_data = JSON.stringify($data);
										$.ajax({																	
											type: 'POST',
											url: "{{URL('admin/product/editProductNo')}}",
											data: {
													'json_data' : json_data
											},
											success: function(response){
												// alert(response);
												result = JSON.parse(response);
												if(result.code==204){													
													alert(result.status);
													var selectedStatus = $('#edit_product_no_input').val();
													$('#edit_product_no_input').addClass('hidden');
													$('#product_no_setter').addClass('hidden');
													$('#edit_product_no').removeClass('hidden');
													$('#product_no_editor').removeClass('hidden');
													$('#edit_product_no').text(selectedStatus);
													// location.reload();
												}
												else
												{
													alert(result.status);
													alert(result.messages);
												}
											},
											error: function(jqXHR, textStatus, errorThrown){
												alert(errorThrown);												
											}
										},'json');
																				
									});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Name</label>
								<div class="col-sm-5">
									<p id="edit_name" class="form-control-static product_name">fsddsf</p>
									<input id="edit_name_input" class="form-control hidden"/>
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="product_name_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="product_name_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#product_name_editor', function() {
										$('#edit_name_input').val($('#edit_name').text());
										$('#edit_name_input').removeClass('hidden');
										$('#product_name_setter').removeClass('hidden');
										$('#edit_name').addClass('hidden');
										$('#product_name_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#product_name_setter', function() {
										$new_name = $('#edit_name_input').val();										
										$data = {
											'id' : $id,
											'new_name' : $new_name
										};
										var json_data = JSON.stringify($data);
										$.ajax({																	
											type: 'POST',
											url: "{{URL('admin/product/editName')}}",
											data: {
													'json_data' : json_data
											},
											success: function(response){
												// alert(response);
												result = JSON.parse(response);
												if(result.code==204){													
													alert(result.status);
													var selectedStatus = $('#edit_name_input').val();
													$('#edit_name_input').addClass('hidden');
													$('#product_name_setter').addClass('hidden');
													$('#edit_name').removeClass('hidden');
													$('#product_name_editor').removeClass('hidden');
													$('#edit_name').text(selectedStatus);
													// location.reload();
												}
												else
												{
													alert(result.status);
													alert(result.messages);
												}
											},
											error: function(jqXHR, textStatus, errorThrown){
												alert(errorThrown);												
											}
										},'json');										
										
									});
									</script>
								</div>
							</div>

							
							<!--<div class="form-group">
								<label class="col-sm-4 control-label">Harga</label>
								<div class="col-sm-5">
									<p id="product_harga" class="form-control-static">34343443</p>
									<input id="product_harga_input" class="form-control hidden"/>
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="product_harga_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="product_harga_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#product_harga_editor', function() {
										$('#product_harga_input').val($('#product_harga').text());
										$('#product_harga_input').removeClass('hidden');
										$('#product_harga_setter').removeClass('hidden');
										$('#product_harga').addClass('hidden');
										$('#product_harga_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#product_harga_setter', function() {
										var selectedStatus = $('#product_harga_input').val();
										$('#product_harga_input').addClass('hidden');
										$('#product_harga_setter').addClass('hidden');
										$('#product_harga').removeClass('hidden');
										$('#product_harga_editor').removeClass('hidden');
										$('#product_harga').text(selectedStatus);
									});
									</script>
								</div>
							</div> -->

							<div class="form-group">
								<label class="col-sm-4 control-label">Description</label>
								<div class="col-sm-5">
									<p id="edit_description" class="form-control-static">fsddsf</p>
									<textarea id="edit_description_input" class="form-control hidden"></textarea>
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="product_description_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="product_description_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#product_description_editor', function() {
										$('#edit_description_input').text($('#edit_description').text());
										$('#edit_description_input').removeClass('hidden');
										$('#product_description_setter').removeClass('hidden');
										$('#edit_description').addClass('hidden');
										$('#product_description_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#product_description_setter', function() {
										$new_description = $('#edit_description_input').val();										
										$data = {
											'id' : $id,
											'new_description' : $new_description
										};
										var json_data = JSON.stringify($data);
										$.ajax({																	
											type: 'POST',
											url: "{{URL('admin/product/editDescription')}}",
											data: {
													'json_data' : json_data
											},
											success: function(response){
												// alert(response);
												result = JSON.parse(response);
												if(result.code==204){													
													alert(result.status);
													var selectedStatus = $('#edit_description_input').val();
													$('#edit_description_input').addClass('hidden');
													$('#product_description_setter').addClass('hidden');
													$('#edit_description').removeClass('hidden');
													$('#product_description_editor').removeClass('hidden');
													$('#edit_description').text(selectedStatus);
													// location.reload();
												}
												else
												{
													alert(result.status);
													alert(result.messages);
												}
											},
											error: function(jqXHR, textStatus, errorThrown){
												alert(errorThrown);												
											}
										},'json');
																				
									});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Category</label>
								<div class="col-sm-5">
									<p id="edit_category_id" class="form-control-static">Kategori 0</p>									
									{{Form::select('edit_category_id_input', $list_category, '', array('id'=>'edit_category_id_input', 'class'=>'form-control hidden'))}}
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="product_category_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="product_category_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#product_category_editor', function() {
										$('#edit_category_id_input').removeClass('hidden');
										$('#product_category_setter').removeClass('hidden');
										$('#edit_category_id').addClass('hidden');
										$('#product_category_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#product_category_setter', function() {
										$new_category_id = $('#edit_category_id_input').val();										
										$data = {
											'id' : $id,
											'new_category_id' : $new_category_id
										};
										var json_data = JSON.stringify($data);
										$.ajax({																	
											type: 'POST',
											url: "{{URL('admin/product/editCategoryId')}}",
											data: {
													'json_data' : json_data
											},
											success: function(response){
												// alert(response);
												result = JSON.parse(response);
												if(result.code==204){													
													alert(result.status);
													var selectedStatus = $('#edit_category_id_input').find(":selected").text();
													$('#edit_category_id_input').addClass('hidden');
													$('#product_category_setter').addClass('hidden');
													$('#edit_category_id').removeClass('hidden');
													$('#product_category_editor').removeClass('hidden');
													$('#edit_category_id').text(selectedStatus);
													// location.reload();
												}
												else
												{
													alert(result.status);
													alert(result.messages);
												}
											},
											error: function(jqXHR, textStatus, errorThrown){
												alert(errorThrown);												
											}
										},'json');
																				
									});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Promotion ID</label>
								<div class="col-sm-5">
									<p id="edit_promotion_id" class="form-control-static">Promotion ID 0</p>									
									{{Form::select('edit_promotion_id_input', $list_promotion, '', array('id'=>'edit_promotion_id_input', 'class'=>'form-control hidden'))}}
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="promotion_id_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="promotion_id_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#promotion_id_editor', function() {
										$('#edit_promotion_id_input').removeClass('hidden');
										$('#promotion_id_setter').removeClass('hidden');
										$('#edit_promotion_id').addClass('hidden');
										$('#promotion_id_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#promotion_id_setter', function() {
										$new_promotion_id = $('#edit_promotion_id_input').val();										
										$data = {
											'id' : $id,
											'new_promotion_id' : $new_promotion_id
										};
										var json_data = JSON.stringify($data);
										$.ajax({																	
											type: 'POST',
											url: "{{URL('admin/product/editPromotionId')}}",
											data: {
													'json_data' : json_data
											},
											success: function(response){
												// alert(response);
												result = JSON.parse(response);
												if(result.code==204){													
													alert(result.status);
													var selectedStatus = $('#edit_promotion_id_input').find(":selected").text();
													$('#edit_promotion_id_input').addClass('hidden');
													$('#promotion_id_setter').addClass('hidden');
													$('#edit_promotion_id').removeClass('hidden');
													$('#promotion_id_editor').removeClass('hidden');
													$('#edit_promotion_id').text(selectedStatus);
													// location.reload();
												}
												else
												{
													alert(result.status);
													alert(result.messages);
												}
											},
											error: function(jqXHR, textStatus, errorThrown){
												alert(errorThrown);												
											}
										},'json');
																				
									});
									</script>
								</div>
							</div>

							<div class="div_edit_price">
							</div>
							<script>
								// $(document).ready(function() {		
									// if(arr_edit_price != "")
									// {
										// var text = '';										
										// text += '<div class="form-group ">';
											// text += '<div class="col-sm-3">';
												// text += '<p id="custom_attr_n" class="form-control-static">attr name</p>';												
												// text += ' <select class="form-control hidden" id="custom_attr_name"><?php foreach($list_attribute as $key => $value){ ?><option value="<?php echo $key; ?>"><?php echo $value; ?></option><?php } ?></select> ';
											// text += '</div>';
											
											// text += '<div class="col-sm-3">';
												// text += '<p id="custom_attr_v" class="form-control-static">attr value</p>';
												// text += '<input id="custom_attr_value" class="form-control hidden"/>';
											// text += '</div>';
											
											// text += '<div class="col-sm-3">';
												// text += '<p id="custom_price_v" class="form-control-static">price value</p>';
												// text += '<input id="custom_price_value" class="form-control hidden"/>';
											// text += '</div>';
											
											// text += '<div class="col-sm-3">';
												// text += '<button type="button" class="btn btn-warning" id="custom_attr_edit">Edit</button>';
												// text += '<button type="button" class="btn btn-success hidden" id="custom_attr_setter">Set</button>';
											// text += '</div>';
										// text += '</div>';
										
										// $('.div_edit_price').html(text);
									// }
								// });
							</script>
							
								<!--
								<div class="form-group ">
									<div class="col-sm-3">
										<p id="custom_attr_n" class="form-control-static">attr name</p>								
										{{Form::select('custom_attr_name', $list_attribute, '', array('id'=>'custom_attr_name', 'class'=>'form-control hidden'))}}
									</div>
									
									<div class="col-sm-3">
										<p id="custom_attr_v" class="form-control-static">attr value</p>
										<input id="custom_attr_value" class="form-control hidden"/>
									</div>
									
									<div class="col-sm-3">
										<p id="custom_price_v" class="form-control-static">price value</p>
										<input id="custom_price_value" class="form-control hidden"/>
									</div>
									
									<div class="col-sm-3">
										<button type="button" class="btn btn-warning" id="custom_attr_edit">Edit</button>
										<button type="button" class="btn btn-success hidden" id="custom_attr_setter">Set</button>
									</div>
								</div>
								-->
								
								<script>										
									$( 'body' ).on( "click",'.custom_attr_edit', function() {										
										$(this).parent().siblings('.div_attr_name').children('.custom_attr_n').addClass('hidden');										
										$(this).parent().siblings('.div_attr_name').children('.custom_attr_name').removeClass('hidden');										
										
										$(this).parent().siblings('.div_attr_value').children('.custom_attr_v').addClass('hidden');										
										$(this).parent().siblings('.div_attr_value').children('.custom_attr_value').removeClass('hidden');										
										
										$(this).parent().siblings('.div_price_value').children('.custom_price_v').addClass('hidden');										
										$(this).parent().siblings('.div_price_value').children('.custom_price_value').removeClass('hidden');										
																				
										$(this).next().removeClass('hidden');										
										
										$(this).addClass('hidden');
									});

									
									$( 'body' ).on( "click",'.custom_attr_setter', function() {
										$new_id = $(this).next().val();
										$new_attr_id = $(this).parent().siblings('.div_attr_name').children('.custom_attr_name').val();										
										$new_attr_value = $(this).parent().siblings('.div_attr_value').children('.custom_attr_value').val();
										$new_price_value = $(this).parent().siblings('.div_price_value').children('.custom_price_value').val();
										$data = {
											'id' : $new_id,
											'new_attr_id' : $new_attr_id,
											'new_attr_value' : $new_attr_value,
											'new_price_value' : $new_price_value
										};
										var json_data = JSON.stringify($data);																																						
										
										//set variable buat change display ajax
										$temp_custom_attr_n = $(this).parent().siblings('.div_attr_name').children('.custom_attr_n');
										$temp_custom_attr_name = $(this).parent().siblings('.div_attr_name').children('.custom_attr_name');
										$temp_custom_attr_v = $(this).parent().siblings('.div_attr_value').children('.custom_attr_v');
										$temp_custom_attr_value = $(this).parent().siblings('.div_attr_value').children('.custom_attr_value');
										$temp_custom_price_v = $(this).parent().siblings('.div_price_value').children('.custom_price_v');
										$temp_custom_price_value = $(this).parent().siblings('.div_price_value').children('.custom_price_value');
										$temp_getter = $(this).prev();
										$temp_this = $(this);
										
										$.ajax({																	
											type: 'POST',
											url: "{{URL('admin/product/editPrice')}}",
											data: {
													'json_data' : json_data
											},
											success: function(response){
												// alert(response);
												result = JSON.parse(response);
												if(result.code==204){													
													alert(result.status);
																
													//set display
													$temp_custom_attr_n.removeClass('hidden');																								
														 $temp = $temp_custom_attr_name.find(":selected").text();
														 $temp_custom_attr_n.text($temp);													
													$temp_custom_attr_name.addClass('hidden');										
													
													$temp_custom_attr_v.removeClass('hidden');										
														$temp_custom_attr_v.text($new_attr_value);
													$temp_custom_attr_value.addClass('hidden');										
													
													$temp_custom_price_v.removeClass('hidden');										
														$temp_custom_price_v.text($new_price_value);										
													$temp_custom_price_value.addClass('hidden');		
													
													$temp_getter.removeClass('hidden');																				
													$temp_this.addClass('hidden');
													
													
													// location.reload();
												}
												else
												{
													alert(result.status);
													alert(result.messages);
												}
											},
											error: function(jqXHR, textStatus, errorThrown){
												alert(errorThrown);												
											}
										},'json');																
																				
									});
									
								</script>																
						
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success saveAddPrice" data-dismiss="modal">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('body').on('click', '.saveAddPrice', function(){		
		var additional_attribute_id = new Array();		
		var additional_attribute_value = new Array();
		var additional_price_value = new Array();
		for($i = initial_count_price; $i < edit_arr_prices.length; $i++)
		{
			if(edit_arr_prices[$i] != -1)
			{
				additional_attribute_id[additional_attribute_id.length] = $(' .edit_new_attr_id_input'+edit_arr_prices[$i]+' ').val();
				additional_attribute_value[additional_attribute_value.length] = $(' .edit_new_attr_value_input'+edit_arr_prices[$i]+' ').val();
				additional_price_value[additional_price_value.length] = $(' .edit_new_price_input'+edit_arr_prices[$i]+' ').val();
			}
		}
		// additional = new Array();
		
		if(additional_attribute_id.length == 0)
		{
			$data = {
				'status' : 'kosong',
				'additional_attribute_id' : '',
				'additional_attribute_value' : '',
				'additional_price_value' : '',
				'product_id' : $id
			};				
		}
		else
		{
			$data = {
				'status' : 'isi',
				'additional_attribute_id' : additional_attribute_id,
				'additional_attribute_value' : additional_attribute_value,
				'additional_price_value' : additional_price_value,
				'product_id' : $id
			};
		}
				
		var json_data = JSON.stringify($data);
		
		$.ajax({		
			type: "POST",
			url: "{{URL('admin/product/additionalPrices')}}",
			data: {
				'json_data' : json_data
			},
			success: function(response){
				// alert(response);
				result = JSON.parse(response);
				if(result.code == 201)
				{
					alert(result.status);
					alert('prices masuk ke database');
				}
				else
				{
					alert(result.status);
					alert(result.messages);
				}					
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('error loh');
				alert(errorThrown);
			}
		},'json');
	});
</script>