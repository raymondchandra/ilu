<div class="modal fade pop_up_view_transaction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Informasi Transaction</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-5">

							<div class="form-group" id="nama_promosi">
								<label class="col-sm-3 control-label">Invoice #</label>
								<div class="col-sm-9">
									<p class="form-control-static">98767954</p>
								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-3 control-label">Total Price</label>
								<div class="col-sm-9">
									<p class="form-control-static">IDR 90.987.000</p>

								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Voucher ID</label>
								<div class="col-sm-9">
									<p class="form-control-static">-</p>

								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Status</label>
								<div class="col-sm-5">
									<p id="transaction_status" class="form-control-static">Pending</p>
									<select id="transaction_status_list" class="form-control hidden">
										<option val="pending">Pending</option>
										<option val="onprocess">Onprocess</option>
										<option val="onship">Onship</option>
										<option val="complete">Complete</option>
									</select>
								</div>
								<div class="col-sm-4">
									<button type="button" class="btn btn-warning" id="transaction_status_editor">Edit</button>
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
								<label for="inputPassword3" class="col-sm-3 control-label">Paid</label>
								<div class="col-sm-5">
									<p id="transaction_paid" class="form-control-static">False</p>
									<select id="transaction_paid_list" class="form-control hidden">
										<option val="true">True</option>
										<option val="false">False</option>
									</select>
								</div>
								<div class="col-sm-4">
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
								<label for="inputPassword3" class="col-sm-3 control-label">Shipment ID</label>
								<div class="col-sm-9">
									<p class="form-5control-static">4657TYU76</p>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Nama Ekspedisi</label>
								<div class="col-sm-9">
									<p class="form-control-static">JNE Epic</p>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Destinasi</label>
								<div class="col-sm-9">
									<p class="form-control-static">Jl. Cibeunying Hegar Epic II No. 2, Bandung</p>
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
											<p class="form-control-static">Muhaudhashdk Nausahjdgjsa</p>
										</div>
									</div>

									<div class="form-group" id="nama_promosi">
										<label class="col-sm-4 control-label">Name in Profile</label>
										<div class="col-sm-8">
											<p class="form-control-static">Muhaudhashdk</p>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Member ID</label>
										<div class="col-sm-8">
											<p class="form-control-static">234234324</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">No KTP</label>
										<div class="col-sm-8">
											<p class="form-control-static">324234234234234234234234564645645</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Email</label>
										<div class="col-sm-8">
											<p class="form-control-static">emailweh@on.com</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Tanggal Lahir</label>
										<div class="col-sm-8">
											<p class="form-control-static">11 Oktober 1950</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Company Name</label>
										<div class="col-sm-8">
											<p class="form-control-static">PT Gono Gini</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Company Address</label>
										<div class="col-sm-8">
											<p class="form-control-static">Jl Gono Gini No. 999</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Member Since</label>
										<div class="col-sm-8">
											<p class="form-control-static">11 Oktober 2014</p>

										</div>
									</div>

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