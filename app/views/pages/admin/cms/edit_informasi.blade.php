<!--<div class="modal fade pop_up_edit_seo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit SEO</h4>
			</div>-->
			<h3>
				Daftar Informasi <button id="f_add_informasi" class="btn btn-success pull-right" style="margin-bottom: 20px;" data-toggle="modal" data-target=".pop_up_add_container_info">+ Add New Info</button>
			</h3>
			<form class="form-horizontal" role="form">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>
								Nama Link
							</th>
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
								Lorem Ipsum
							</td>
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

							<button class="btn btn-success f_add_new_section" >
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
												<input type="radio" name="metode_pengisian" id="inlineRadio1" value="gambar" checked> Gambar
											</label>
											<label class="radio-inline">
												<input type="radio" name="metode_pengisian" id="inlineRadio2" value="deskripsi"> Deskripsi
											</label>
										</div>
									</div>

									<div class="form-group" id="gambar_edit_cont_info">
										<label class="col-sm-4 control-label" >Upload Gambar</label>
										<div class="col-sm-7">
											<img srs="" width="200" height="200"/>
											<input type="file" class="" id="">
										</div>
									</div>

									<div class="form-group hidden" id="deskripsi_edit_cont_info">
										<label class="col-sm-4 control-label" >Tulis Deskripsi</label>
										<div class="col-sm-7">
											<textarea id="deskripsi_edit_info"></textarea>
											<script>tinymce.init({selector:'#deskripsi_edit_info'});</script>
										</div>
									</div>
								</div>
								<script>

								$('body').on('change', 'input:radio[name="metode_pengisian"]', function() {

									if ($(this).is(':checked') && $(this).val() == 'gambar') {
										$('#deskripsi_edit_cont_info').addClass('hidden');
										$('#gambar_edit_cont_info').removeClass('hidden');
									}else{
										$('#deskripsi_edit_cont_info').removeClass('hidden');
										$('#gambar_edit_cont_info').addClass('hidden');
									}

								});
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
					<button type="button" class="btn btn-danger" data-dismiss="modal">Ya</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
				  </div>
				</div>
			  </div>
			</div>
		<!--</div>
	</div>
</div>-->