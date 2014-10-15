<div class="modal fade pop_up_view_attribute" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Informasi Shipment</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12"><!-- col-sm-5 -->


							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Nama Attribute</label>
								<div class="col-sm-3">
									<p id="nama_attribute" class="form-control-static">Sesuatu</p>
									<input id="nama_attribute_input" type="text" class="form-control hidden" value="">	
								</div>
								<div class="col-sm-1">
									<button type="button" class="btn btn-warning" id="nama_attribute_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="nama_attribute_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#nama_attribute_editor', function() {
										$('#nama_attribute_input').val($('#nama_attribute').text());
										$('#nama_attribute_input').removeClass('hidden');
										$('#nama_attribute_setter').removeClass('hidden');
										$('#nama_attribute').addClass('hidden');
										$('#nama_attribute_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#nama_attribute_setter', function() {
									//	var selectedStatus = $('#nama_attribute_input').text($('#nama_attribute').text());
										$('#nama_attribute_input').addClass('hidden');
										$('#nama_attribute_setter').addClass('hidden');
										$('#nama_attribute').removeClass('hidden');
										$('#nama_attribute_editor').removeClass('hidden');
										$('#nama_attribute').text($('#nama_attribute_input').val());
									});
									</script>
								</div>
								<div class="col-sm-3">
									<span class="btn btn-danger">Nama attribute ini sudah ada</span>	
								</div>
							</div>
						</div>
					</div>



					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>