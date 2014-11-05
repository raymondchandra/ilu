<!--<div class="modal fade pop_up_edit_seo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit SEO</h4>
			</div>-->
			<h3>
				Daftar Informasi <button id="f_add_informasi" class="btn btn-success pull-right" style="margin-bottom: 20px;" data-toggle="modal" data-target=".pop_up_add_info">+ Add New Info</button>
			</h3>
			<form class="form-horizontal" role="form">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>
								Judul Informasi
							</th>
							<th>
								IMG 
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
								<img src=""/>
							</td>
							<td>
								<button type="button" class="btn btn-success" data-toggle="modal" data-target=".pop_up_detail_info">Detail</button>
							</td>
						</tr>
					</tbody>
				</table>
				
			</form>

			<!-- modal add -->
			<div class="modal fade pop_up_add_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title title1" id="myModalLabel">Tambah Informasi</h4>
						</div>
						<div class="form-horizontal" role="form">
							<div class="modal-body">


								<div class="form-group" id="nama_container_info">
									<label class="col-sm-4 control-label">Judul Informasi</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="judul_info">
									</div>
								</div>

								<div class="form-group" id="metode_container_info">
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

								<div class="form-group" id="gambar_container_info">
									<label class="col-sm-4 control-label" >Upload Gambar</label>
									<div class="col-sm-7">
										<img srs="" width="200" height="200"/>
										<input type="file" class="" id="">
									</div>
								</div>

								<div class="form-group hidden" id="deskripsi_container_info">
									<label class="col-sm-4 control-label" >Tulis Deskripsi</label>
									<div class="col-sm-7">
										<textarea id="deskripsi_info"></textarea>
										<script>tinymce.init({selector:'#deskripsi_info'});</script>
									</div>
								</div>
								<script>

							    $('body').on('change', 'input:radio[name="metode_pengisian"]', function() {

									if ($(this).is(':checked') && $(this).val() == 'gambar') {
							            $('#deskripsi_container_info').addClass('hidden');
							            $('#gambar_container_info').removeClass('hidden');
							        }else{
							            $('#deskripsi_container_info').removeClass('hidden');
							            $('#gambar_container_info').addClass('hidden');
							        }

								});
								</script>


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success f_add_to_table" data-dismiss="modal">Add Info Baru</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
								<script>
								$('body').on('click', '.f_add_to_table', function() {

									var info_baru ='<tr>';
									info_baru+='		<td>';
									info_baru+='		'+ $('#judul_info').val() +'';
									info_baru+='		</td>';
									info_baru+='		<td>';
									info_baru+='		<img src="">';
									info_baru+='		</td>';
									info_baru+='		<td>';
									info_baru+='		<button type="button" class="btn btn-success" data-toggle="modal" data-target=".pop_up_detail_info">Detail</button>';
									info_baru+='		</td>';
									info_baru+='	</tr>';
									$('.f_info_table').append(info_baru);

								});
								</script>
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


								<div class="form-group" id="nama_edit_cont_info">
									<label class="col-sm-4 control-label">Judul Informasi</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="judul_info">
									</div>
								</div>

								<div class="form-group" id="metode_edit_cont_info">
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
		<!--</div>
	</div>
</div>-->