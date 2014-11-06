<div class="modal fade pop_up_view_transaction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Information Transaction</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-5">

							<div class="form-group" id="nama_promosi">
								<label class="col-sm-4 control-label">Invoice</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="invoice"></p>
								</div>
							</div>


							<!--<div class="form-group">
								<label class="col-sm-4 control-label">Total Price</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="price"></p>

								</div>
							</div>-->

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Voucher ID</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="voucher"></p>

								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Status</label>
								<div class="col-sm-5">
									<p id="transaction_status" class="form-control-static" ></p>
									<select id="transaction_status_list" class="form-control hidden">
										<option value="Cancel">Cancel</option>
										<option value="Pending">Pending</option>
										<option value="On-process">On-process</option>
										<option value="On-ship">On-ship</option>
										<option value="Complete">Complete</option>
									</select>
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="transaction_status_editor">Edit</button>
									<input type="hidden" value="" id="idTrans">
									<input type="hidden" value="" id="idShip">
									<button type="button" class="btn btn-success hidden" id="transaction_status_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#transaction_status_editor', function() {
										$('#transaction_status_list').removeClass('hidden');
										$('#transaction_status_setter').removeClass('hidden');
										$('#transaction_status').addClass('hidden');
										$('#transaction_status_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#transaction_status_setter', function() {
										var selectedStatus = $('#transaction_status_list').find(":selected").text();
										$('#transaction_status_list').addClass('hidden');
										$('#transaction_status_setter').addClass('hidden');
										$('#transaction_status').removeClass('hidden');
										$('#transaction_status_editor').removeClass('hidden');
										$('#transaction_status').text(selectedStatus);
									});
									</script>
								</div>
							</div>

							
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Paid</label>
								<div class="col-sm-5">
									<p id="transaction_paid" class="form-control-static"></p>
									<select id="transaction_paid_list" class="form-control hidden">
										<option value="1">Paid</option>
										<option value="0">Unpaid</option>
									</select>
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="transaction_paid_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="transaction_paid_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#transaction_paid_editor', function() {
										$('#transaction_paid_list').removeClass('hidden');
										$('#transaction_paid_setter').removeClass('hidden');
										$('#transaction_paid').addClass('hidden');
										$('#transaction_paid_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#transaction_paid_setter', function() {
										var selectedStatus = $('#transaction_paid_list').find(":selected").text();
										$('#transaction_paid_list').addClass('hidden');
										$('#transaction_paid_setter').addClass('hidden');
										$('#transaction_paid').removeClass('hidden');
										$('#transaction_paid_editor').removeClass('hidden');
										$('#transaction_paid').text(selectedStatus);
									});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Shipping Number</label>
								<div class="col-sm-5">
									<p class="form-control-static" id="idShipment"></p>
									<input type="text" class="form-control hidden" id="idShipment_text">
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="transaction_sn_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="transaction_sn_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#transaction_sn_editor', function() {
									var selectedSN = $('#idShipment').text();
										$('#idShipment_text').val(selectedSN);
										$('#idShipment_text').removeClass('hidden');
										$('#transaction_sn_setter').removeClass('hidden');
										$('#idShipment').addClass('hidden');
										$('#transaction_sn_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#transaction_sn_setter', function() {
										var selectedSN = $('#idShipment_text').val();
										$('#idShipment_text').addClass('hidden');
										$('#transaction_sn_setter').addClass('hidden');
										$('#idShipment').removeClass('hidden');
										$('#transaction_sn_editor').removeClass('hidden');
										$('#idShipment').text(selectedSN);
									});
									</script>
								</div>
								
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Kurir</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="courier"></p>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Destinasi</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="destinasi"></p>
								</div>
							</div>
						</div>



						<div class="col-sm-7">
							<div class="panel panel-default">
								<div class="panel-heading">Informasi Pelanggan</div>
								<div class="panel-body">
									<div class="form-group" id="nama_promosi">
										<label class="col-sm-4 control-label">Full Name</label>
										<div class="col-sm-8">
											<p class="form-control-static" id="full_name"></p>
										</div>
									</div>

									<div class="form-group" id="nama_promosi">
										<label class="col-sm-4 control-label">Name in Profile</label>
										<div class="col-sm-8">
											<p class="form-control-static" id="prof_name"></p>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Member ID</label>
										<div class="col-sm-8">
											<p class="form-control-static" id="memberId"></p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">No KTP</label>
										<div class="col-sm-8">
											<p class="form-control-static" id="noKtp"></p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Email</label>
										<div class="col-sm-8">
											<p class="form-control-static" id="email"></p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Tanggal Lahir</label>
										<div class="col-sm-8">
											<p class="form-control-static" id="ttl"></p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Company Name</label>
										<div class="col-sm-8">
											<p class="form-control-static" id="comName"></p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Company Address</label>
										<div class="col-sm-8">
											<p class="form-control-static" id="comAdd"></p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Member Since</label>
										<div class="col-sm-8">
											<p class="form-control-static" id="MemberSince"></p>

										</div>
									</div>

								</div>
							</div>
							
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<table class="table table-bordered" id="f_table_detail_transaksi">
								<thead>
									<tr>
										<th>
											Nama Barang
										</th>
										<th>
											Harga Barang
										</th>
										<th>
											Qty
										</th>
										<th>
											Subtotal
										</th>
									</tr>
								</thead>
								<tbody id="produk">
									
								</tbody>
							</table>
						</div>
						<div class="col-lg-6 col-lg-push-6">
							<div class="form-group" id="nama_promosi">
								<label class="col-sm-4 control-label">Total Price</label>
								<div class="col-sm-8">
									<p class="form-control-static" id="price"></p>
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