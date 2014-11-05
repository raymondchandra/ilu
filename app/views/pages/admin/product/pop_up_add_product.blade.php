<div class="modal fade pop_up_add_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Product</h4>
				
			</div>
			<form class="form-horizontal" role="form">								
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12" id="f_add_product_container">
						<button type="button" id="f_add_new_attr" class="btn btn-success pull-right">
							Add New Attribute
						</button>
						<script>
							$('body').on('click','#f_add_new_attr',function(){	
								arr_attr[arr_attr.length] = idx_attr_row;
								
								var new_line = '<div class="form-group">'
								new_line+='	<div class="col-sm-3 ">';							
								new_line+=' <select class="form-control new_attr_id_input'+idx_attr_row+'"><?php foreach($list_attribute as $key => $value){ ?><option value="<?php echo $key; ?>"><?php echo $value; ?></option><?php } ?></select> ';
								new_line+='	</div>';
								new_line+='	<div class="col-sm-4">';
								new_line+='		<input type="text" class="form-control new_attr_value_input'+idx_attr_row+'" placeholder="value"/>';
								new_line+='	</div>';
								new_line+='	<div class="col-sm-3">';
								new_line+='		<input type="text" onkeypress="return isNumberKey(event)" class="form-control new_price_input'+idx_attr_row+'" placeholder="harga (optional)"/>';
								new_line+='	</div>';
								new_line+='	<div class="col-sm-2">';								
								new_line+='		<input type="hidden" value="'+idx_attr_row+'"/><button type="button" class="btn btn-danger f_delete_row_attr">X</button>';
								new_line+='	</div>';
								new_line+='</div>';
								$('#f_add_product_container').append(new_line);
								
								idx_attr_row++;
							});
							
							function isNumberKey(evt){
								var charCode = (evt.which) ? evt.which : event.keyCode
								if (charCode > 31 && (charCode < 48 || charCode > 57))
									return false;
								return true;
							}
						</script>

							<div class="form-group">
								<label class="col-sm-4 control-label">Name</label>
								<div class="col-sm-5">
									<input id="new_name_input" type="text" class="form-control"/>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label">Produk No.</label>
								<div class="col-sm-5">
									<input id="new_product_no_input" type="text" class="form-control "/>
								</div>
							</div>														

							<div class="form-group">
								<label class="col-sm-4 control-label">Description</label>
								<div class="col-sm-5">
									<textarea id="new_description_input" class="form-control"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Category</label>
								<div class="col-sm-5">									
									@if($list_category != null)
										{{Form::select('new_category_id_input', $list_category, Input::old('list_category'), array('id'=>'new_category_id_input', 'class'=>'form-control'))}}
									@else
										<input id="new_category_id" type="text" class="form-control" value='' disabled=true />
									@endif
								</div>
							</div>							

							<div class="form-group">
								<label class="col-sm-4 control-label">Promotion ID</label>
								<div class="col-sm-5">
									@if($list_promotion != null)
										{{Form::select('new_promotion_id_input', $list_promotion, Input::old('list_promotion'), array('id'=>'new_promotion_id_input', 'class'=>'form-control'))}}
									@else
										<input id="new_promotion_id_input" type="text" class="form-control" value='' disabled=true />
									@endif
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label">Product Image</label>
								<div class="col-sm-5">
									<img src="" id="show_main_photo" width="200" height="200">
									<!--<input type='text' value='fakfakfak' />-->
									{{ Form::file("main_photo_input", array("name"=>"main_photo_input","class"=>"main_photo_input", "accept" => "image/*")) }}
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Product Galery</label>
								<div class="col-sm-5">
									<button type="button" class="btn btn-primary f_add_photo"><span class="glyphicon glyphicon-plus"></span>Add Photo</button>
								</div>
							</div>
							<div class="form-group">
						<div class="col-sm-8 col-sm-push-2">
							
							<table class="table">
								
								<tbody id="product_gallery_add">
									
								</tbody>
							</table>
						</div>
						</div>

						</div>
						<script>
					/*
					Script untuk add baris produk
					*/
					$( '.f_add_photo' ).on( "click", function() {
						arr_photos[arr_photos.length] = idx_photos_row;
						
						var text =' <tr>';						
						text +=' <td><img src="" width="150" height="150" class="pull-right showImage'+idx_photos_row+'" /></td>';
						text +=' <td><input type="hidden" value="'+idx_photos_row+'" /><input type="file" class="other_photos_input'+idx_photos_row+' other_photos_change" accept="image/*" /></td>';						
						text +=' <td><input type="hidden" value="'+idx_photos_row+'"/><button type="button" class="btn btn-danger f_remove_photo"><span class="glyphicon glyphicon-remove"></span></button></td>';
						text +='</tr>';
						$('#product_gallery_add').append(text);
						
						idx_photos_row++;
					});
										
					$('body').on('change','.main_photo_input',function(){
						var i = 0, len = this.files.length, img, reader, file;	
						// alert($(this).prev().val());
							//document.getElementById("images").disabled = true;
						for ( ; i < len; i++ ) {
							file = this.files[i];
							if (!!file.type.match(/image.*/)) {
								if ( window.FileReader ) {
									reader = new FileReader();
									reader.onloadend = function (e) { 										
										$('#show_main_photo').attr('src', e.target.result);																	
									};
									reader.readAsDataURL(file);
								}
								imageUpload = file;
							}	
						}
					});	
										
					$('body').on('change','.other_photos_change',function(){
						var i = 0, len = this.files.length, img, reader, file;
						var idx = $(this).prev().val();						
							//document.getElementById("images").disabled = true;
						for ( ; i < len; i++ ) {
							file = this.files[i];
							if (!!file.type.match(/image.*/)) {
								if ( window.FileReader ) {
									reader = new FileReader();
									reader.onloadend = function (e) { 																														
										$(' .showImage'+idx+' ').attr('src', e.target.result);
									};
									reader.readAsDataURL(file);
								}
								imageUpload = file;
							}	
						}
					});	
										
					/*
					Script untuk remove baris produk
					*/
					$( 'body' ).on( "click",'.f_remove_photo', function() {
						//delete from arr_photos
						$id_del_photos = $(this).prev().val();
						for($i = 0; $i < arr_photos.length; $i++)
						{
							if(arr_photos[$i] == $id_del_photos)
							{
								arr_photos[$i] = -1;
							}
						}
						
						$(this).parent().parent().hide(300, function(){ 
							$(this).remove(); 
						});
						
						alert(arr_photos);
					});
					
					/*
					Script untuk remove baris attribute baru
					*/
					$( 'body' ).on( "click",'.f_delete_row_attr', function() {					
						//delete from arr_attr
						$id_del_attr = $(this).prev().val();
						for($i = 0; $i < arr_attr.length; $i++)
						{
							if(arr_attr[$i] == $id_del_attr)
							{
								arr_attr[$i] = -1;
							}
						}
						
						$(this).parent().parent().hide(300, function(){ 
							$(this).remove(); 
						});
						
						alert(arr_attr);
					});										

					</script>

						<!--
						<div class="col-sm-7">
							<div class="panel panel-default">
								<div class="panel-heading">Informasi Pelanggan</div>
								<div class="panel-body">
									<div class="form-group" id="nama_promosi">
										<label class="col-sm-4 control-label">Full Name</label>
										<div class="col-sm-8">
											<p class="form-control-static">Muhaudhashdk Nausahjdgjsa</p>
										</div>
									</div>

									<div class="form-group" id="nama_promosi">
										<label class="col-sm-4 control-label">Name in Profile</label>
										<div class="col-sm-8">
											<p class="form-control-static">Muhaudhashdk</p>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Member ID</label>
										<div class="col-sm-8">
											<p class="form-control-static">234234324</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">No KTP</label>
										<div class="col-sm-8">
											<p class="form-control-static">324234234234234234234234564645645</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Email</label>
										<div class="col-sm-8">
											<p class="form-control-static">emailweh@on.com</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Tanggal Lahir</label>
										<div class="col-sm-8">
											<p class="form-control-static">11 Oktober 1950</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Company Name</label>
										<div class="col-sm-8">
											<p class="form-control-static">PT Gono Gini</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Company Address</label>
										<div class="col-sm-8">
											<p class="form-control-static">Jl Gono Gini No. 999</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Member Since</label>
										<div class="col-sm-8">
											<p class="form-control-static">11 Oktober 2014</p>

										</div>
									</div>

								</div>
							</div>
							
						</div> -->
					</div>



					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success addButton" data-dismiss="modal">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('body').on('click','.addButton', function(){
		var data, xhr;
		data = new FormData();
				
		$name = $('#new_name_input').val();			
			data.append('name', $name);
		$product_no = $('#new_product_no_input').val();			
			data.append('product_no', $product_no);
		$description = $('#new_description_input').val();			
			data.append('description', $description);
		$category_id = $('#new_category_id_input').val();
			data.append('category_id', $category_id);
		$promotion_id = $('#new_promotion_id_input').val();
			data.append('promotion_id', $promotion_id);
		$deleted = 0;
			data.append('deleted', $deleted);		
			
			
		$main_photo = $('.main_photo_input')[0].files[0];
			data.append('main_photo', $main_photo);
		
		// var array_input_other_photos = new Array();
		// var temp_name_other_photos = "other_photos_";
		// var temp_idx_other_photos = 1;		

		for($j=0; $j<arr_photos.length; $j++){
			if(arr_photos[$j] != -1){	
				// alert((temp_name_other_photos+temp_idx_other_photos));
				data.append((temp_name_other_photos+temp_idx_other_photos), $(' .other_photos_input'+arr_photos[$j]+' ')[0].files[0] );
				// alert($(' .other_photos_input'+arr_photos[$j]+' ')[0].files[0]);				
				array_input_other_photos[array_input_other_photos.length] = (temp_name_other_photos+temp_idx_other_photos);
				temp_idx_other_photos++;
			}
		}
		data.append('other_photos_name', array_input_other_photos);
		
		
		// var attributes_id_input = new Array();
		// var attributes_value_input = new Array();
		// var prices_input = new Array();		
		for($i=0; $i<arr_attr.length; $i++){
			if(arr_attr[$i] != -1){
				attributes_id_input[attributes_id_input.length] = $(' .new_attr_id_input'+arr_attr[$i]+' ').val();
				attributes_value_input[attributes_value_input.length] = $(' .new_attr_value_input'+arr_attr[$i]+' ').val();
				prices_input[prices_input.length] = $(' .new_price_input'+arr_attr[$i]+' ').val();
			}
		}
		data.append('arr_attr_id', attributes_id_input);
		data.append('arr_attr_value', attributes_value_input);
		data.append('arr_price', prices_input);
						
		
		$.ajax({
			type: 'POST',
			url: "{{URL('admin/product/addProduct')}}",						
			// data: {
				// json: JSON.stringify({'json_data' : data})				
				// 'json_data' : JSON.stringify(data)
			// },
			data: data,
			cache: false,
			processData: false,
			contentType: false,	
			// dataType: 'json',
			success: function(response){			
				result = JSON.parse(response);
				if(result.code == 200)
				{	
					alert(result.status);
					location.reload();					
				}
				else
				{
					alert(result.status);
					alert(result.messages);
				}				
			},
			error:function(errorThrown){
				alert('errror loh');
				alert(errorThrown);
			}
		},'json');	
		
	});
</script>