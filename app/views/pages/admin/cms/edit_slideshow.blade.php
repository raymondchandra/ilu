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
									Caption
								</th>
								<th>
									Img
								</th>
								<th>
									Command
								</th>
							</tr>
						</thead>
						<tbody class="f_tbody_slideshow">
							<tr>
								<td>
									Page
								</td>
								<td>
									<img src="" width="160" height="120" alt=""/>
								</td>
								<td>
									<button class="btn btn-warning" data-toggle="modal" data-target=".pop_up_edit_image">
										Edit
									</button>
									<button class="btn btn-danger" data-toggle="modal" data-target=".pop_up_delete_image">
										Delete
									</button>
								</td>
							</tr>
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


								<div class="form-group" id="nama_edit_cont_info">
									<label class="col-sm-4 control-label">Caption</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="new_caption">
									</div>
								</div>


								<div class="form-group" id="nama_edit_cont_info">
									<label class="col-sm-4 control-label">Image</label>
									<div class="col-sm-7">
										<input type="file" class="" id="">
										<img src="" width="200" height="150" alt="">
									</div>
								</div>


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success f_save_to_tbody" data-dismiss="modal">Save</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
							</div>
							<script>
							$('body').on('click','.f_save_to_tbody',function(){
								var cap = $('#new_caption').val();
									//alert(cap);
								var tr = '<tr>';
								tr += '<td>';
								tr += ''+ cap +'';
								tr += '</td>';
								tr += '<td>';
								tr += '	<img src="" width="160" height="120" alt=""/>';
								tr += '</td>';
								tr += '<td>';
								tr += '	<button class="btn btn-warning" data-toggle="modal" data-target=".pop_up_edit_image">';
								tr += '		Edit';
								tr += '	</button>';
								tr += '	<button class="btn btn-danger" data-toggle="modal" data-target=".pop_up_delete_image">';
								tr += '		Delete';
								tr += '	</button>';
								tr += '</td>';
								tr += '</tr>';

								$('.f_tbody_slideshow').append(tr);

							});
							</script>
						</div>
					</div>
				</div>
			</div>			

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


								<div class="form-group" id="nama_edit_cont_info">
									<label class="col-sm-4 control-label">Caption</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="">
									</div>
								</div>


								<div class="form-group" id="nama_edit_cont_info">
									<label class="col-sm-4 control-label">Image</label>
									<div class="col-sm-7">
										<input type="file" class="" id="">
										<img src="" width="200" height="150" alt="">
									</div>
								</div>


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
							</div>
						</div>
					</div>
				</div>
			</div>

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
					<button type="button" class="btn btn-danger" data-dismiss="modal">Ya</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
				  </div>
				</div>
			  </div>
			</div>