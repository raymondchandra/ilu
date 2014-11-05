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
									<input type="file"/>
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
							text +=' <td><input type="hidden" value="'+edit_idx_photos_row+'" /><input type="file" class="other_photos_input'+edit_idx_photos_row+' other_photos_change" accept="image/*" /></td>';						
							text +=' <td><input type="hidden" value="'+edit_idx_photos_row+'"/><button type="button" class="btn btn-danger f_remove_edit_photo"><span class="glyphicon glyphicon-remove"></span></button></td>';
							text +='</tr>';							
							$('#product_photo_edit').append(text);
							
							alert(edit_arr_photos);
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
							
							$(this).parent().parent().hide(300, function(){ 
								$(this).remove(); 
							});
							
							alert(edit_arr_photos);
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
		
	});
</script>