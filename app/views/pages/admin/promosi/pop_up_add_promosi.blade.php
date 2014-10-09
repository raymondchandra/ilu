<div class="modal fade pop_up_add_promosi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Tambah Promosi Baru</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form">
					<div class="row">
						<div class="col-sm-6">

							<div class="form-group has-success has-feedback" id="nama_promosi">
								<label class="col-sm-3 control-label">Name *</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" placeholder="Promo Hebat">		
									<span class="glyphicon glyphicon-ok form-control-feedback"></span>		
								</div>
							</div>


							<div class="form-group has-error has-feedback">
								<label class="col-sm-3 control-label">Nilai *</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" placeholder="700000">
									<span class="glyphicon glyphicon-remove form-control-feedback"></span>				
								</div>
							</div>

							<div class="form-group has-error has-feedback">
								<label for="inputPassword3" class="col-sm-3 control-label">Operator *</label>
								<div class="col-sm-9">
									<select class="form-control">
										<option value="">Pilih Operator!</option>
										<option value="percent">Percent (%)</option>
										<option value="minus">Minus (-)</option>
									</select>	
									<span class="glyphicon glyphicon-remove form-control-feedback"></span>			
								</div>
							</div>
						</div>



						<div class="col-sm-6">
							<div class="form-group has-success has-feedback">
								<label class="col-sm-4 control-label">Dari Tanggal</label>
								<div class='input-group date col-sm-7'>
									<input type='text' class="form-control"  id='datepicker00'/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar" >
										</span>
									</span>
								</div>
							</div>
							<script type="text/javascript">
							$(function () {
								$('#datepicker00').datepicker();
							});
							</script>

							<div class="form-group has-error has-feedback">
								<label class="col-sm-4 control-label">Sampai Tanggal</label>
								<div class='input-group date col-sm-7'>
									<input type='text' class="form-control"  id='datepicker01'/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar" >
										</span>
									</span>
								</div>
							</div>
							<script type="text/javascript">
							$(function () {
								$('#datepicker01').datepicker();
							});
							</script>
						</div>
					</div>

					<hr></hr>

					<div class="form-group">
						<label class="col-sm-3 control-label">Nama Product</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" placeholder="">		
							<table class="table table-bordered table-hover f_table_suggestion" style="position: absolute; background-color: #fff;">
								<tr id="_product">
									<td width="67"><img src="{{asset('assets/img/1x1.jpg')}}" width="50" class="pull-right"/></td>
									<td>Nama Product</td></a>
								</tr>
								<tr id="_product">
									<td width="67"><img src="{{asset('assets/img/1x1.jpg')}}" width="50" class="pull-right"/></td>
									<td>Nama Product</td>
								</tr>
								<tr id="_product">
									<td width="67"><img src="{{asset('assets/img/1x1.jpg')}}" width="50" class="pull-right"/></td>
									<td>Nama Product</td>
								</tr>
								<tr id="_product">
									<td width="67"><img src="{{asset('assets/img/1x1.jpg')}}" width="50" class="pull-right"/></td>
									<td>Nama Product</td>
								</tr>
								<tr id="_product">
									<td width="67"><img src="{{asset('assets/img/1x1.jpg')}}" width="50" class="pull-right"/></td>
									<td>Nama Product</td>
								</tr>
							</table>	
						</div>
						<div class="col-sm-1">
							<button type="button" class="btn btn-primary f_add_product"><span class="glyphicon glyphicon-plus"></span></button>
						</div>
					</div>

					<table class="table">
						<thead>
							<tr>
								<th width="150">Gambar</th>
								<th>Nama Product</th>
								<th>Harga Awal (IDR)</th>
								<th>Harga Promosi (IDR)</th>
								<th>Remove</th>
							</tr>
						</thead>
						<tbody id="product_promo_list">
							<tr>
								<td><img src="{{asset('assets/img/1x1.jpg')}}" width="150" class="pull-right"/></td>
								<td>Nama Product</td>
								<td>3125000</td>
								<td>3000000</td>
								<td><button type="button" class="btn btn-danger f_remove_product"><span class="glyphicon glyphicon-remove"></span></button></td>
							</tr>
							<tr>
								<td><img src="{{asset('assets/img/1x1.jpg')}}" width="150" class="pull-right"/></td>
								<td>Nama Product</td>
								<td>3125000</td>
								<td>3000000</td>
								<td><button type="button" class="btn btn-danger f_remove_product"><span class="glyphicon glyphicon-remove"></span></button></td>
							</tr>
							<tr>
								<td><img src="{{asset('assets/img/1x1.jpg')}}" width="150" class="pull-right"/></td>
								<td>Nama Product</td>
								<td>3125000</td>
								<td>3000000</td>
								<td><button type="button" class="btn btn-danger f_remove_product"><span class="glyphicon glyphicon-remove"></span></button></td>
							</tr>
							<tr>
								<td><img src="{{asset('assets/img/1x1.jpg')}}" width="150" class="pull-right"/></td>
								<td>Nama Product</td>
								<td>3125000</td>
								<td>3000000</td>
								<td><button type="button" class="btn btn-danger f_remove_product"><span class="glyphicon glyphicon-remove"></span></button></td>
							</tr>
							<tr>
								<td><img src="{{asset('assets/img/1x1.jpg')}}" width="150" class="pull-right"/></td>
								<td>Nama Product</td>
								<td>3125000</td>
								<td>3000000</td>
								<td><button type="button" class="btn btn-danger f_remove_product"><span class="glyphicon glyphicon-remove"></span></button></td>
							</tr>
							<tr>
								<td><img src="{{asset('assets/img/1x1.jpg')}}" width="150" class="pull-right"/></td>
								<td>Nama Product</td>
								<td>3125000</td>
								<td>3000000</td>
								<td><button type="button" class="btn btn-danger f_remove_product"><span class="glyphicon glyphicon-remove"></span></button></td>
							</tr>
						</tbody>
					</table>
					<script>
					
					/*
					Script untuk add baris produk
					*/
					$( '.f_add_product' ).on( "click", function() {
						var text =' <tr>';
						text +='		<td><img src="{{asset("assets/img/1x1.jpg")}}" width="150" class="pull-right"/></td>';
						text +='		<td>Nama Product</td>';
						text +='		<td>3125000</td>';
						text +='		<td>3000000</td>';
						text +='		<td><button type="button" class="btn btn-danger f_remove_product"><span class="glyphicon glyphicon-remove"></span></button></td>';
						text +='	</tr>';
						$('#product_promo_list').prepend(text);
						
					});

					/*
					Script untuk remove baris produk
					*/
					$( 'body' ).on( "click",'.f_remove_product', function() {
						$(this).parent().parent().hide(300, function(){ 
							$(this).remove(); 
						});
					});

					</script>


					

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Ya</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
			</div>
		</div>
	</div>
</div>