<div class="modal fade pop_up_view_order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Informasi Order</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">

							<div class="form-group" id="nama_promosi">
								<label class="col-sm-4 control-label">Order No.</label>
								<div class="col-sm-8">
									<p class="form-control-static">0000000</p>
								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-4 control-label">Transaction No.</label>
								<div class="col-sm-8">
									<p class="form-control-static">00045600</p>

								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Purchased On</label>
								<div class="col-sm-8">
									<p class="form-control-static">Sep 28, 2014 11:54:09 PM</p>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Bill to Name</label>
								<div class="col-sm-8">
									<p class="form-control-static">Nama Pembeli</p>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Ship to Name </label>
								<div class="col-sm-8">
									<p class="form-control-static">Nama Penerima</p>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Product Name</label>
								<div class="col-sm-8">
									<p class="form-control-static">Tas Epic</p>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Qty</label>
								<div class="col-sm-8">
									<p class="form-control-static">3</p>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Harga Satuan</label>
								<div class="col-sm-8">
									<p class="form-control-static">IDR 300.000</p>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Harga Total </label>
								<div class="col-sm-8">
									<p class="form-control-static">IDR 900.000</p>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-4 control-label">Status</label>
								<div class="col-sm-5">
									<p id="order_status" class="form-control-static">Pending</p>
									<select id="order_status_list" class="form-control hidden">
										<option value="Pending">Pending</option>
										<option value="On-process">On-process</option>
										<option value="Complete">Complete</option>
									</select>
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="order_status_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="order_status_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#order_status_editor', function() {
										$('#order_status_list').removeClass('hidden');
										$('#order_status_setter').removeClass('hidden');
										$('#order_status').addClass('hidden');
										$('#order_status_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#order_status_setter', function() {
										var selectedStatus = $('#order_status_list').find(":selected").text();
										$('#order_status_list').addClass('hidden');
										$('#order_status_setter').addClass('hidden');
										$('#order_status').removeClass('hidden');
										$('#order_status_editor').removeClass('hidden');
										$('#order_status').text(selectedStatus);
									});
									</script>
								</div>
							</div>

						</div>


						<!--
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
							
						</div> -->
					</div>



					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>