<div class="modal fade pop_up_view_shipping_agent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

							<div class="form-group" id="nama_promosi">
								<label class="col-sm-4 control-label">ID Kurir</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="idAgent"></p>
								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-4 control-label">Nama Kurir</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="namaKurir"></p>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Dari Kota</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="dari"></p>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Destinasi</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="tujuan"></p>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Harga Pengiriman</label>
								<div class="col-sm-5">
									<p id="harga_pengiriman" class="form-control-static"></p>
									<input id="harga_pengiriman_input" type="text" class="form-control hidden" value="">	
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="harga_pengiriman_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="harga_pengiriman_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#harga_pengiriman_editor', function() {
										$('#harga_pengiriman_input').val($('#harga_pengiriman').text());
										$('#harga_pengiriman_input').removeClass('hidden');
										$('#harga_pengiriman_setter').removeClass('hidden');
										$('#harga_pengiriman').addClass('hidden');
										$('#harga_pengiriman_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#harga_pengiriman_setter', function() {
									//	var selectedStatus = $('#harga_pengiriman_input').text($('#harga_pengiriman').text());
										$('#harga_pengiriman_input').addClass('hidden');
										$('#harga_pengiriman_setter').addClass('hidden');
										$('#harga_pengiriman').removeClass('hidden');
										$('#harga_pengiriman_editor').removeClass('hidden');
										$('#harga_pengiriman').text($('#harga_pengiriman_input').val());
									});
									</script>
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