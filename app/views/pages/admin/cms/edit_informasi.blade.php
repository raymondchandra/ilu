<!--<div class="modal fade pop_up_edit_seo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit SEO</h4>
			</div>-->
		<script>
			$('document').ready(function(){
				$.ajax({
					type: 'GET',
					url: "{{URL('admin/information')}}",
					success: function(response){
						if(response.code == 404){
							
						}
						else{
							var msgs = response.messages;
							var div = '';
							$(msgs).each(function(){
								div+="<tr>";
								div+="<td>";
								div+=$(this)[0].title;
								div+="</td>";
								div+="<td>";
								div+="<button type='button' class='btn btn-warning' data-toggle='modal' data-target='.pop_up_detail_info'>Edit</button>";
								div+="<input type='hidden' value='"+$(this)[0].id+"' />";
								div+="<button type='button' class='btn btn-danger delete_info' data-toggle='modal' data-target='.pop_up_delete_info'>Delete</button>";
								div+="</td>";
								div+="</tr>";
							});
							$('.f_info_table').html(div);
						}
						
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(errorThrown);
					}
				});
			});
		</script>
			<h3>
				Daftar Informasi <button id="f_add_informasi" class="btn btn-success pull-right" style="margin-bottom: 20px;" data-toggle="modal" data-target=".pop_up_add_container_info">+ Add New Info</button>
			</h3>
			<form class="form-horizontal" role="form">
				<table class="table table-bordered">
					<thead>
						<tr>
							<!--<th>
								Nama Link
							</th>-->
							<th>
								Judul Informasi
							</th>
							<th>
								Command 
							</th>
						</tr>
					</thead>
					<tbody class="f_info_table">
						<tr>
							<td>
								Das Epic
							</td>
							<td>
								<button type="button" class="btn btn-warning" data-toggle="modal" data-target=".pop_up_detail_info">Edit</button>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target=".pop_up_delete_info">Delete</button>
							</td>
						</tr>
					</tbody>
				</table>

			</form>

			<!-- modal add -->
			<div class="modal fade pop_up_add_container_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title title1" id="myModalLabel">Add Container Informasi</h4>
						</div>
						<div class="form-horizontal" role="form">
							<div class="modal-body">


								<div class="form-group" id="">
									<label class="col-sm-4 control-label">Nama Link</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="">
									</div>
								</div>

								<div class="form-group" id="">
									<label class="col-sm-4 control-label">Judul Informasi</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="">
									</div>
								</div>


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success" data-dismiss="modal">Add Container Info</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- modal add -->
			<div class="modal fade pop_up_detail_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title title1" id="myModalLabel">Detail Informasi</h4>
						</div>
						<div class="form-horizontal" role="form">	
							
							<div class="modal-body">

							<button type="button" class="btn btn-success f_add_new_section" >
								Add New Section
							</button>

								<div class="f_section_container">
									<div class="form-group" id="">
										<label class="col-sm-4 control-label">Judul Section</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" id="">
										</div>
									</div>

									<div class="form-group" id="">
										<label class="col-sm-4 control-label">Metoda Pengisian Data</label>
										<div class="col-sm-7">
											<label class="radio-inline">
												<input type="radio" name="metode_pengisian0" id="inlineRadio1" value="gambar0" checked> Gambar
											</label>
											<label class="radio-inline">
												<input type="radio" name="metode_pengisian0" id="inlineRadio2" value="deskripsi0"> Deskripsi
											</label>
										</div>
									</div>

									<div class="form-group" id="gambar_edit_cont_info0">
										<label class="col-sm-4 control-label" >Upload Gambar</label>
										<div class="col-sm-7">
											<img srs="" width="200" height="200"/>
											<input type="file" class="" id="">
										</div>
									</div>

									<div class="form-group hidden" id="deskripsi_edit_cont_info0">
										<label class="col-sm-4 control-label" >Tulis Deskripsi</label>
										<div class="col-sm-7">
											<textarea id="deskripsi_edit_info0"></textarea>
										</div>
									</div>
								</div>
								
								<div class="f_section_container_appenden">

								</div>

								<script>
								var i=0;
								tinymce.init({selector:'#deskripsi_edit_info0'});

								$('body').on('click','.f_add_new_section', function(){
									i++;

							var new_add_info ='<div class="f_section_container">';
									new_add_info +='<div class="form-group" id="">';
									new_add_info +='	<label class="col-sm-4 control-label">Judul Section </label>';
									new_add_info +='	<div class="col-sm-7">';
									new_add_info +='		<input type="text" class="form-control" id="">';
									new_add_info +='	</div>';
									new_add_info +='</div>';

									new_add_info += '<div class="form-group" id="">';
									new_add_info += '	<label class="col-sm-4 control-label">Metoda Pengisian Data</label>';
									new_add_info += '	<div class="col-sm-7">';
									new_add_info += '		<label class="radio-inline">';
									new_add_info += '			<input type="radio" name="metode_pengisian" id="inlineRadio1" value="gambar" checked> Gambar';
									new_add_info += '		</label>';
									new_add_info += '		<label class="radio-inline">';
									new_add_info += '			<input type="radio" name="metode_pengisian" id="inlineRadio2" value="deskripsi"> Deskripsi';
									new_add_info += '		</label>';
									new_add_info += '	</div>';
									new_add_info += '</div>';

									new_add_info +=' <div class="form-group gambar_edit_cont_info">';
									new_add_info +=' 	<label class="col-sm-4 control-label" >Upload Gambar</label>';
									new_add_info +=' 	<div class="col-sm-7">';
									new_add_info +=' 		<img srs="" width="200" height="200"/>';
									new_add_info +=' 		<input type="file" class="" id="">';
									new_add_info +=' 	</div>';
									new_add_info +=' </div>';

									new_add_info +='<div class="form-group hidden deskripsi_edit_cont_info">';
									new_add_info +='	<label class="col-sm-4 control-label" >Tulis Deskripsi</label>';
									new_add_info +='	<div class="col-sm-7">';
									new_add_info +='		<textarea id="deskripsi_edit_info'+i+'"></textarea>';
									new_add_info += '</div>';
									new_add_info += '</div>';
								new_add_info += '</div>';

								var s = document.createElement("script");
								s.type = "text/javascript";
								s.innerHTML = "tinymce.init({selector:'#deskripsi_edit_info"+i+"'});";


									$('.f_section_container_appenden').append(new_add_info).append(s);

								});

								$('body').on('change', 'input:radio[name="metode_pengisian0"]', function() {
									if ($(this).is(':checked') && $(this).val() == 'gambar0') {
										$('#deskripsi_edit_cont_info0').addClass('hidden');
										$('#gambar_edit_cont_info0').removeClass('hidden');
									}else{
										$('#deskripsi_edit_cont_info0').removeClass('hidden');
										$('#gambar_edit_cont_info0').addClass('hidden');
									}

								});

								$('body').on('change', 'input:radio[name="metode_pengisian"]', function() {
									if ($(this).is(':checked') && $(this).val() == 'gambar') {
										$(this).parent().parent().parent().siblings('.deskripsi_edit_cont_info').addClass('hidden');
										$(this).parent().parent().parent().siblings('.gambar_edit_cont_info').removeClass('hidden');
									}else{
										$(this).parent().parent().parent().siblings('.deskripsi_edit_cont_info').removeClass('hidden');
										$(this).parent().parent().parent().siblings('.gambar_edit_cont_info').addClass('hidden');
									}

								});
								
								$('body').on('click','.delete_info',function(){
									$id = $(this).prev().val();
									$('#deleted_id').val($id);
								})
								</script>



							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success" data-dismiss="modal">Update Info Baru</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal ".alertYesNo"-->
			<div class="modal fade pop_up_delete_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
					<button type="button" class="btn btn-danger yes-delete" data-dismiss="modal">Ya</button>
					<input type='hidden' id='deleted_id' />
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
				  </div>
				</div>
			  </div>
			</div>
			
		<script>
			$('body').on('click','.yes-delete',function(){
				$id = $(this).next().val();
				$.ajax({
					type: 'DELETE',
					url: "{{URL('admin/information')}}/"+$id,
					success: function(response){
						if(response.code == 200){
							$.ajax({
								type: 'GET',
								url: "{{URL('admin/information')}}",
								success: function(response){
									if(response.code == 404){
										
									}
									else{
										var msgs = response.messages;
										var div = '';
										$(msgs).each(function(){
											div+="<tr>";
											div+="<td>";
											div+=$(this)[0].title;
											div+="</td>";
											div+="<td>";
											div+="<button type='button' class='btn btn-warning' data-toggle='modal' data-target='.pop_up_detail_info'>Edit</button>";
											div+="<input type='hidden' value='"+$(this)[0].id+"' />";
											div+="<button type='button' class='btn btn-danger delete_info' data-toggle='modal' data-target='.pop_up_delete_info'>Delete</button>";
											div+="</td>";
											div+="</tr>";
										});
										$('.f_info_table').html(div);
										alert('Success Delete Information');
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
		<!--</div>
	</div>
</div>-->