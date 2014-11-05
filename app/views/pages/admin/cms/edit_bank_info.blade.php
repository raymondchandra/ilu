
			<h3>
				Bank<button type="button" class="btn btn-success pull-right" id="f_add_new_bank">
				Add New Bank
			</button>
		</h3>
		<form class="form-horizontal" role="form">
			<div class="modal-body">
				<div class="bank_area">


					<table class="table table-bordered" style="margin-top: 20px;">
						<thead>
							<th>
								Nama Bank
							</th>
							<th>
								Nomer Rekening
							</th>
							<th>
								Nama Nasabah
							</th>
							<th>
								Command
							</th>
						</thead>
						<tbody class="f_tbody_bank">
							<tr>
								<td>
									<input type="text" class="form-control" placeholder="">
								</td>
								<td>
									<input type="text" class="form-control" placeholder="">
								</td>
								<td>
									<input type="text" class="form-control" placeholder="">
								</td>
								<td>
									<button type="button" class="btn btn-danger f_delete_bank">Delete</button>
								</td>
							</tr>
						</tbody>
					</table>
					<script>
					$('body').on('click','#f_add_new_bank',function(){
						var tr_bank='<tr>';
						tr_bank +='		<td>';
						tr_bank +='			<input type="text" class="form-control" placeholder="">';
						tr_bank +='		</td>';
						tr_bank +='		<td>';
						tr_bank +='			<input type="text" class="form-control" placeholder="">';
						tr_bank +='		</td>';
						tr_bank +='		<td>';
						tr_bank +='			<input type="text" class="form-control" placeholder="">';
						tr_bank +='		</td>';
						tr_bank +='		<td>';
						tr_bank +='			<button type="button" class="btn btn-danger f_delete_bank">Delete</button>';
						tr_bank +='		</td>';
						tr_bank +='	</tr>';

						$('.f_tbody_bank').append(tr_bank);

							//alert('dsa');
						});

					$('body').on('click','.f_delete_bank',function(){

						$(this).parent().parent().remove();

							//alert('dsa');
						});

					</script>
				</div>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
				<!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button> -->
			</div>
		</form>
		<!--</div>
	</div>
</div>-->