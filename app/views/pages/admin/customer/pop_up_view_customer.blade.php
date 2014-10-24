<div class="modal fade pop_up_view_customer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Informasi Customer</h4>
			</div>
			<div class="form-horizontal" role="form">
				<div class="modal-body">
					
					
					<div class="form-group" id="nama_promosi">
						<label class="col-sm-4 control-label">Full Name</label>
						<div class="col-sm-8">
							<p class="form-control-static" id="custName"></p>
						</div>
					</div>

					<div class="form-group" id="nama_promosi">
						<label class="col-sm-4 control-label" >Name in Profile</label>
						<div class="col-sm-8">
							<p class="form-control-static" id="custProfileName"></p>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Member ID</label>
						<div class="col-sm-8">
							<p class="form-control-static" id="custMemberID"></p>

						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">No KTP</label>
						<div class="col-sm-8">
							<p class="form-control-static" id="custKTP"></p>

						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Email</label>
						<div class="col-sm-8">
							<p class="form-control-static" id="custEmail"></p>

						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Tanggal Lahir</label>
						<div class="col-sm-8">
							<p class="form-control-static" id="custBirthDate"></p>

						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Company Name</label>
						<div class="col-sm-8">
							<p class="form-control-static" id="custCompany"></p>

						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Company Address</label>
						<div class="col-sm-8">
							<p class="form-control-static" id="custCompanyAddress"></p>

						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Member Since</label>
						<div class="col-sm-8">
							<p class="form-control-static" id="custMemberDate"></p>

						</div>
					</div>

					<hr></hr>
					<h4 class="modal-title" id="myModalLabel">Informasi Voucher
						<button class="btn btn-success pull-right btn-xs tambah_voucher_trigger">
							<span class="glyphicon glyphicon-plus"></span>Tambah Voucher
						</button>
						<script>
						$('body').on('click','.tambah_voucher_trigger', function(){
							$('.tambah_voucher').removeClass('hidden').addClass('display');
						});
							
						</script>
					</h4>
					

					<hr></hr>
					<div class="tambah_voucher hidden">
						<div class="form-group col-sm-4">
							<label class="col-sm-4 control-label">Type</label>
							<div class="col-sm-8">
								<select class="form-control">
									<option>Public</option>
									<option>Private</option>
								</select>

							</div>
						</div>

						<div class="form-group col-sm-4">
							<label class="col-sm-4 control-label">Ammount</label>
							<div class="col-sm-8">
								<input type=""text class="form-control" id="">

							</div>
						</div>

						<div class="form-group col-sm-4">
							<label class="col-sm-4 control-label">Code</label>
							<div class="col-sm-8">
								<p type=""text class="form-control-static" id="">4353d54d34</p>

							</div>
						</div>
						<button class="btn btn-success pull-right btn-xs">
							<span class="glyphicon glyphicon-plus"></span>Add
						</button>
					</div>

					<table class="table">
						<thead>
							<tr>
								<th>
									Type
								</th>
								<th>
									Ammount
								</th>
								<th>
									Code
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									Public
								</td>
								<td>
									IDR 500.000
								</td>
								<td>
									543efr43r
								</td>
							</tr>
							<tr>
								<td>
									A
								</td>
								<td>
									IDR 500.000
								</td>
								<td>
									543efr43r
								</td>
							</tr>
							<tr>
								<td>
									Private
								</td>
								<td>
									IDR 500.000
								</td>
								<td>
									543efr43r
								</td>
							</tr>
							<tr>
								<td>
									Public
								</td>
								<td>
									IDR 500.000
								</td>
								<td>
									543efr43r
								</td>
							</tr>
						</tbody>
						
					</table>

					
					



					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
				</div>
			</div>
		</div>
	</div>
</div>