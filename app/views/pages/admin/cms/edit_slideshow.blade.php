<!--<div class="modal fade pop_up_edit_seo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit SEO</h4>
			</div>-->
			<h3>
				Slideshow <button id="f_add_informasi" class="btn btn-success pull-right" style="margin-bottom: 20px;" data-toggle="modal" data-target=".pop_up_new_image">+ Add New Image</button>
			</h3>
			<span class="clear-fix">
			</span>

					<table class="table table-bordered" style="margin-top: 20px;">
						<thead>
							<tr>
								<th>
									Img
								</th>
								<th>
									Command
								</th>
							</tr>
						</thead>
						<tbody class="f_tbody_slideshow">
							
						</tbody>
					</table>
					


			<!-- modal add -->
			<div class="modal fade pop_up_new_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title title1" id="myModalLabel">Add New Image</h4>
						</div>
						<div class="form-horizontal" role="form">
							<div class="modal-body">


								<!--<div class="form-group" id="nama_edit_cont_info">
									<label class="col-sm-4 control-label">Caption</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="new_caption">
									</div>
								</div>-->


								<div class="form-group" id="nama_edit_cont_info">
									<label class="col-sm-4 control-label">Image</label>
									<div class="col-sm-7">
										<input type="file" class="" id="image_uploader">
										<img src="" width="200" id='image_preview' height="150" alt="">
									</div>
								</div>


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success f_save_to_tbody upload_image" data-dismiss="modal">Save</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
							</div>
							<script>
							var uploaded_image = '';
							$('#image_uploader').change(function(){
								var i = 0, len = this.files.length, img, reader, file;
								for ( ; i < len; i++ ){
									file = this.files[i];
									if (!!file.type.match(/image.*/)) {
										if ( window.FileReader ) {
											reader = new FileReader();
											reader.onloadend = function (e) {
												$('#image_preview').attr('src',e.target.result);
											};
											reader.readAsDataURL(file);
										}
									}
									uploaded_image = file;
								}
							});
							
							
							$('body').on('click','.upload_image',function(){
								//alert(uploaded_image);
								var formdata = new FormData();
								formdata.append("image", uploaded_image);
								$.ajax({
									type: 'POST',
									url: "{{URL('admin/slideshow')}}",
									data:formdata,
									processData: false,
									contentType: false,
									success: function(response){
										if(response.code == 201){
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
										}
									},
									error: function(jqXHR, textStatus, errorThrown){
										alert(errorThrown);
									}
								});
							});
							
							$('body').on('click','.delete_slideshow',function(){
								$('#deleted_id').val($(this).prev().val());
							})
							
							$('body').on('click','.edit_slideshow',function(){
								$source = $(this).parent().siblings('.photo_preview').children('.preview_image').attr('src');
								$('#edit_image_preview').attr('src',$source);
								$('#id_slideshow').val($(this).next().val());
							})
							</script>
						</div>
					</div>
				</div>
			</div>	
			<script>			
			$('.pop_up_new_image').on('hidden.bs.modal', function (e) {
			  //alert('modal closed');
			  //-- fungsi untuk me-reset sluruh input[type=text] pada modal --
			  $(this).find('img').attr('src','');
			})
			</script>			

			<!-- modal edit -->
			<div class="modal fade pop_up_edit_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title title1" id="myModalLabel">Edit New Image</h4>
						</div>
						<div class="form-horizontal" role="form">
							<div class="modal-body">


								<!--<div class="form-group" id="nama_edit_cont_info">
									<label class="col-sm-4 control-label">Caption</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="">
									</div>
								</div>-->


								<div class="form-group" id="nama_edit_cont_info">
									<label class="col-sm-4 control-label">Image</label>
									<div class="col-sm-7">
										<input type="file" class="" id="image_update_uploader">
										<img src="" id='edit_image_preview' width="200" height="150" alt="">
									</div>
								</div>


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success update_slideshow" data-dismiss="modal">Save</button>
								<input type='hidden' id='id_slideshow' />
								<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<script>
				$('#image_update_uploader').change(function(){
					var i = 0, len = this.files.length, img, reader, file;
					for ( ; i < len; i++ ){
						file = this.files[i];
						if (!!file.type.match(/image.*/)) {
							if ( window.FileReader ) {
								reader = new FileReader();
								reader.onloadend = function (e) {
								$('#edit_image_preview').attr('src',e.target.result);
							};
							reader.readAsDataURL(file);
							}
						}
						uploaded_image = file;
					}
				});
							
				$('body').on('click','.update_slideshow',function(){
					$id = $(this).next().val();
					var formdata = new FormData();
					formdata.append("image", uploaded_image);
					$.ajax({
						type: 'POST',
						url: "{{URL('admin/slideshow')}}/"+$id,
						data:formdata,
						processData: false,
						contentType: false,
						success: function(response){
							if(response.code == 201){
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
							}
						},
						error: function(jqXHR, textStatus, errorThrown){
							alert(errorThrown);
						}
					});
				});
				
			</script>

			<!-- Modal ".alertYesNo"-->
			<div class="modal fade pop_up_delete_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Alert!</h4>
				  </div>
				  <div class="modal-body"  style="text-align: center;">
						Apakah Anda yakin ingin menghapus image ini?
				  </div>
				  <div class="modal-footer" style="text-align: center;">
					<button type="button" class="btn btn-danger yes_delete" data-dismiss="modal">Ya</button>
					<input type='hidden' id='deleted_id' />
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
				  </div>
				</div>
			  </div>
			</div>
			<script>
				$('body').on('click','.yes_delete',function(){
					$id = $(this).next().val();
					$.ajax({
						type: 'DELETE',
						url: "{{URL('admin/slideshow')}}/"+$id,
						success: function(response){
							if(response.code == 200){
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
							}
						},
						error: function(jqXHR, textStatus, errorThrown){
							alert(errorThrown);
						}
					});
				});
			</script>