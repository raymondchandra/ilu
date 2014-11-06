<div class="modal fade pop_up_edit_product_gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Edit Product Gallery</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
						
							<div class="form-group">
								<label class="col-sm-4 control-label">Product Image</label>
								<div class="col-sm-5">
									<img id="edit_show_main_photo" src="" width="200" height="200">
									{{ Form::file("edit_main_photo_input", array("name"=>"edit_main_photo_input","class"=>"edit_main_photo_input", "accept" => "image/*")) }}
									<input id="edit_main_photo_id" type="hidden" value="" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Product Galery</label>
								<div class="col-sm-5">
									<button type="button" class="btn btn-primary f_edit_photo"><span class="glyphicon glyphicon-plus"></span>Add Photo</button>
								</div>
							</div>

						</div>
						<div class="col-sm-8 col-sm-push-2">
							
							<table class="table">
								
								<tbody id="product_photo_edit">									
									<!--<tr>
										<td><img src="" width="150" height="150" class="pull-right"/></td>
										<td><input type="file"></td>
										<td><button type="button" class="btn btn-danger f_remove_edit_photo"><span class="glyphicon glyphicon-remove"></span></button></td>
									</tr>-->
								</tbody>
							</table>
						</div>
						<script>
							/*
							Script untuk add baris produk
							*/
							$( '.f_edit_photo' ).on( "click", function() {
								edit_arr_photos[edit_arr_photos.length] = edit_idx_photos_row;
							
								var text =' <tr>';						
								text +=' <td><img src="" width="150" height="150" class="pull-right showImage'+edit_idx_photos_row+'" /></td>';
								text +=' <td><input type="hidden" value="'+edit_idx_photos_row+'" /><input type="file" class="edit_other_photos_input'+edit_idx_photos_row+' edit_other_photos_change" accept="image/*" /></td>';						
								text +=' <td><input type="hidden" value="" /><input type="hidden" value="'+edit_idx_photos_row+'"/><button type="button" class="btn btn-danger f_remove_edit_photo"><span class="glyphicon glyphicon-remove"></span></button></td>';
								text +='</tr>';							
								$('#product_photo_edit').append(text);
								
								edit_idx_photos_row++;
								
								alert(edit_arr_photos);
							});
							
							$('body').on('change','.edit_main_photo_input',function(){
								var i = 0, len = this.files.length, img, reader, file;	
								// alert($(this).prev().val());
									//document.getElementById("images").disabled = true;
								for ( ; i < len; i++ ) {
									file = this.files[i];
									if (!!file.type.match(/image.*/)) {
										if ( window.FileReader ) {
											reader = new FileReader();
											reader.onloadend = function (e) { 										
												$('#edit_show_main_photo').attr('src', e.target.result);																	
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
							$( 'body' ).on( "click",'.f_remove_edit_photo', function() {
								// delete from arr_photos
								$edit_id_del_photos = $(this).prev().val();
								for($i = 0; $i < edit_arr_photos.length; $i++)
								{
									if(edit_arr_photos[$i] == $edit_id_del_photos)
									{
										edit_arr_photos[$i] = -1;
									}
								}
								
								edit_arr_delete[edit_arr_delete.length] = $(this).prev().prev().val();
								
								$(this).parent().parent().hide(300, function(){ 
									$(this).remove(); 
								});
								
								alert(edit_arr_delete);
								
								alert(edit_arr_photos);
							});
							
							$('body').on('change','.edit_other_photos_change',function(){
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
						</script>

					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success editPhoto" data-dismiss="modal">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('body').on('click', '.editPhoto', function(){
		var data, xhr;
		data = new FormData();
		
		
		//buat edit main photo
		if($('.edit_main_photo_input').val() == "")
		{
			$main_photo = "";
			$files_main_photo = "";
		}		
		else
		{
			$main_photo = "isi";
			$files_main_photo = $('.edit_main_photo_input')[0].files[0];
		}		
			data.append('edit_main_photo', $main_photo);	
			data.append('edit_files_main_photo', $files_main_photo);
			
		$main_photo_id = $('#edit_main_photo_id').val();
			// alert($main_photo_id);
			data.append('edit_main_photo_id', $main_photo_id);
		
		
		// alert("main photo" + $main_photo);	
		// alert("files main photo " + $files_main_photo);	
		// alert("main photo id" + $main_photo_id);	
		// alert("product id" + $id);
		
		
		for($j=0; $j<edit_arr_photos.length; $j++){
			if(edit_arr_photos[$j] != -1){	
				// alert( $(' .edit_other_photos_input'+edit_arr_photos[$j]+' ').parent().next().children().first().val() );
				
				if( $(' .edit_other_photos_input'+edit_arr_photos[$j]+' ').val() != "")
				{					
					//edit yg sebelomnya udh ada
					if( $(' .edit_other_photos_input'+edit_arr_photos[$j]+' ').parent().next().children().first().val() != "") // dapet id gallery other photos
					{
						edit_arr_id[edit_arr_id.length] = $(' .edit_other_photos_input'+edit_arr_photos[$j]+' ').parent().next().children().first().val(); //id
						edit_arr_files[edit_arr_files.length] = (edit_temp_name_other_photos+edit_temp_idx_other_photos); //nama selector												
						
						// alert('masuk yg foto sebelomnya');
					}
					
					// alert('wooops');
					data.append((edit_temp_name_other_photos+edit_temp_idx_other_photos), $(' .edit_other_photos_input'+edit_arr_photos[$j]+' ')[0].files[0] );				
					
					edit_array_input_other_photos[edit_array_input_other_photos.length] = (edit_temp_name_other_photos+edit_temp_idx_other_photos);
					edit_temp_idx_other_photos++;	
										
				}												
				
			}
		}		
			data.append('edit_other_photos_name', edit_array_input_other_photos);
				
		data.append('edit_arr_id', edit_arr_id);
		data.append('edit_arr_files', edit_arr_files);
		
		// alert(edit_array_input_other_photos);
		// alert(edit_arr_id);
		// alert(edit_arr_files);
		
		
		
		
		data.append('edit_arr_delete', edit_arr_delete)	;
		
		
		data.append('product_id', $id);	
			
		
		$.ajax({
			type: 'POST',
			url: "{{URL('admin/product/editGallery')}}",						
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
				// alert(response);
				
				result = JSON.parse(response);
				if(result.code == 204)
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