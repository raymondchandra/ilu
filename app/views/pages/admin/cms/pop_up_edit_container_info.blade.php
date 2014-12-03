
<div class="modal fade pop_up_edit_container_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title title1" id="myModalLabel">Edit Detail Informasi</h4>
						</div>
						<div class="form-horizontal" role="form">	
							
							<div class="modal-body">
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
												<input type="radio" name="metode_pengisian3" id="inlineRadio1" value="gambar3" checked> Gambar
											</label>
											<label class="radio-inline">
												<input type="radio" name="metode_pengisian3" id="inlineRadio2" value="deskripsi3"> Deskripsi
											</label>
										</div>
									</div>

									<div class="form-group" id="gambar_edit_cont_info3">
										<label class="col-sm-4 control-label" >Upload Gambar</label>
										<div class="col-sm-7">
											<img srs="" width="200" height="200"/>
											<input type="file" class="" id="">
										</div>
									</div>

									<div class="form-group hidden" id="deskripsi_edit_cont_info3">
										<label class="col-sm-4 control-label" >Tulis Deskripsi</label>
										<div class="col-sm-7">
											<textarea id="deskripsi_edit_info3"></textarea>
										</div>
									</div>
								</div>
								


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success" data-dismiss="modal">Update Info Baru</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script>
				$('body').on('change', 'input:radio[name="metode_pengisian3"]', function() {
					if ($(this).is(':checked') && $(this).val() == 'gambar3') {
						$('#deskripsi_edit_cont_info3').addClass('hidden');
						$('#gambar_edit_cont_info3').removeClass('hidden');
					}else{
						$('#deskripsi_edit_cont_info3').removeClass('hidden');
						$('#gambar_edit_cont_info3').addClass('hidden');
					}

				});
												tinymce.init({selector:'#deskripsi_edit_info3'});


			</script>