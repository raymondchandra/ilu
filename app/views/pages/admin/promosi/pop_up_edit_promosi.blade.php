<script>
	//temp update 
	var temp_edit_id;
	var temp_edit_name;
	var temp_edit_price;
	var temp_edit_photo;
	
	var temp_arr_product_detail;
	
	//list update product
	var arr_edit_id = new Array();
	
</script>

<div class="modal fade pop_up_edit_promosi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Promosi</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">

							<div class="form-group has-success has-feedback" id="nama_promosi">
								<label class="col-sm-3 control-label">Name *</label>
								<div class="col-sm-9">
									<input id="edit_name_input" type="text" class="form-control" placeholder="Promo Hebat">		
									<span class="glyphicon glyphicon-ok form-control-feedback"></span>		
								</div>
							</div>


							<div class="form-group has-error has-feedback">
								<label class="col-sm-3 control-label">Nilai *</label>
								<div class="col-sm-9">
									<input id="edit_amount_input" type="text" onkeypress="return isNumberKey(event)" class="form-control" placeholder="700000">
									<span class="glyphicon glyphicon-remove form-control-feedback"></span>				
								</div>
							</div>

							<!--<div class="form-group has-error has-feedback">
								<label for="inputPassword3" class="col-sm-3 control-label">Operator *</label>
								<div class="col-sm-9">
									<select class="form-control">
										<option value="">Pilih Operator!</option>
										<option value="percent">Percent (%)</option>
										<option value="minus">Minus (-)</option>
									</select>	
									<span class="glyphicon glyphicon-remove form-control-feedback"></span>			
								</div>
							</div>-->
						</div>



						<div class="col-sm-6">
							<div class="form-group has-success has-feedback">
								<label class="col-sm-4 control-label">Dari Tanggal</label>
								<div class='input-group date col-sm-7'>
									<input type='text' class="form-control edit_start_date_input"  id='datepicker02'/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar" >
										</span>
									</span>
								</div>
							</div>
							<script type="text/javascript">
							$(function () {								
								 $('#datepicker02').datepicker({
									format: 'yyyy-mm-dd'
								 });								
							});
							</script>

							<div class="form-group has-error has-feedback">
								<label class="col-sm-4 control-label">Sampai Tanggal</label>
								<div class='input-group date col-sm-7'>
									<input type='text' class="form-control edit_expired_input"  id='datepicker03'/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar" >
										</span>
									</span>
								</div>
							</div>
							<script type="text/javascript">
							$(function () {								
								 $('#datepicker03').datepicker({
									format: 'yyyy-mm-dd'
								 });								
							});
							</script>
						</div>
					</div>

					<hr></hr>

					<div class="form-group">
						<label class="col-sm-3 control-label">Nama Product</label>
							<div class="col-sm-7">
								<!--<input onkeypress="search_product()" id="edit_promoted_product_input" type="text" class="form-control" placeholder="">-->
								<input id="edit_promoted_product_input" type="text" class="form-control" placeholder="">								
								<div style="height: 200px; overflow-y:visible;">
									<table class="table table-bordered table-hover f_table_suggestion hidden" style="position: absolute; background-color: #fff;">								
										@foreach($list_product as $product)											
											<tr class="f_table_suggestion_item">
												<input class="f_table_suggestion_item_id" type='hidden' value='{{$product->id}}'>
												<input class="f_table_suggestion_item_name" type='hidden' value='{{$product->name}}'>	
												<!--<input class="f_table_suggestion_item_price" type='hidden' value=''>
												<input class="f_table_suggestion_item_attr_name" type='hidden' value=''>
												<input class="f_table_suggestion_item_attr_value" type='hidden' value=''>-->
												@if($product->main_photo == '')
													<input class="f_table_suggestion_item_main_photo" type='hidden' value=''>
													<td width="67"><img src="" alt="no photo" width="50" class="pull-right"/></td>
												@else
													<input class="f_table_suggestion_item_main_photo" type='hidden' value='{{$product->main_photo}}'>
													<td width="67"><img src="{{asset($product->main_photo)}}" width="50" class="pull-right"/></td>
												@endif																					
												<td>{{$product->name}}</td>
												<td></td>												
											</tr>																				
										@endforeach
										<!--<tr id="_product">
											<td width="67"><img src="{{asset('assets/img/1x1.jpg')}}" width="50" class="pull-right"/></td>
											<td>Nama Product</td></a></tr>-->
									</table>	
								</div>	
							</div>
							<div class="col-sm-1">
								<button type="button" class="btn btn-primary" id="f_add_edit_product"><span class="glyphicon glyphicon-plus"></span></button>
							</div>
						</div>
					<!--<div class="form-group">
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
							<button type="button" class="btn btn-primary f_add_edit_product"><span class="glyphicon glyphicon-plus"></span></button>
						</div>
					</div>-->

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
						<tbody id="edit_product_promo_list">
							<!--<tr>
								<td><img src="{{asset('assets/img/1x1.jpg')}}" width="150" class="pull-right"/></td>
								<td>Nama Product</td>
								<td>3125000</td>
								<td>3000000</td>
								<td><button type="button" class="btn btn-danger f_remove_product"><span class="glyphicon glyphicon-remove"></span></button></td>
							</tr>-->
						</tbody>
					</table>
					<script>
					
					/*
					Script untuk add baris produk
					*/
					$( '#f_add_edit_product' ).on( "click", function() {					
						if($('#edit_amount_input').val() == '')
						{
							alert('fill amount first!');
						}						
						else
						{									
							if($('#edit_promoted_product_input').val() == '')		
							{
								alert('nama product kosong !');
							}
							else
							{												
								arr_edit_id[arr_edit_id.length] = temp_id;
								
								$data = {
									'id' : temp_id
								};								
								temp_json_data = JSON.stringify($data);
								
								//get product by id
								$.ajax({
									type: 'GET',									
									url: "{{URL('admin/promotion/getProductById')}}",
									data : {
										'json_data' : temp_json_data
									},
									success: function(response){
										result = JSON.parse(response);	
										// alert(result.messages['prices'][0]['attr_value']);
										// alert(result.messages['prices'][0]['price_with_tax']);
										
										for($i = 0; $i<result.messages['prices'].length; $i++)
										{
											//isi table yang udh termasuk id promosi
											text = "";
											text +='<tr>';
											// text +='<td><img src="{{asset("assets/img/1x1.jpg")}}" width="150" class="pull-right"/></td>';
											if(result.messages['main_photo'] == '')
											{
												text +='<td><img src="" alt="no photo" width="150" class="pull-right"/></td>';
											}
											else
											{
												text +='<td><img src="{{asset("'+result.messages['main_photo']+'")}}" width="150" class="pull-right"/></td>';
											}								
											text +='<td>'+result.messages['name']+' , '+result.messages['prices'][$i]['attr_name']+' : '+result.messages['prices'][$i]['attr_value']+'</td>';
											text +='<td>'+result.messages['prices'][$i]['price_with_tax']+'</td>';
											text +='<td>'+(result.messages['prices'][$i]['price_with_tax']-$('#edit_amount_input').val())+'</td>';													
											text +='<td><input type="hidden" value="'+result.messages['id']+'"/>';
											text +='<button type="button" class="btn btn-danger f_remove_product"><span class="glyphicon glyphicon-remove"></span></button></td>';
											text +='</tr>';
											$('#edit_product_promo_list').prepend(text);	
										}										
										
										// alert(result.messages['name']);
										// alert('fak');
										alert('edit length'+arr_edit_id.length);
										alert(JSON.stringify(arr_edit_id));
									},
									error: function(jqXHR, textStatus, errorThrown){
										alert(errorThrown);
									}
								},'json');
								
								/*
								text = '';
								text += '<tr>';
								// text +='<td><img src="{{asset("assets/img/1x1.jpg")}}" width="150" class="pull-right"/></td>';
								if(temp_photo == '')
								{
									text +='<td><img src="" alt="no photo" width="150" class="pull-right"/></td>';
								}
								else
								{
									text +='<td><img src="{{asset("'+temp_photo+'")}}" width="150" class="pull-right"/></td>';
								}								
								text +='<td>'+temp_name+'</td>';
								text +='<td>'+temp_price+'</td>';
								text +='<td>'+ (temp_price-$temp_amount) +' </td>';													
								text +='<td><input type="hidden" value="'+temp_id+'/><button type="button" class="btn btn-danger f_remove_product"><span class="glyphicon glyphicon-remove"></span></button></td>';
								text +='</tr>';
								$('#edit_product_promo_list').prepend(text);	
								*/
							}	
						}
						
						
						// var text =' <tr>';
						// text +='		<td><img src="{{asset("assets/img/1x1.jpg")}}" width="150" class="pull-right"/></td>';
						// text +='		<td>Nama Product</td>';
						// text +='		<td>3125000</td>';
						// text +='		<td>3000000</td>';
						// text +='		<td><button type="button" class="btn btn-danger f_remove_product"><span class="glyphicon glyphicon-remove"></span></button></td>';
						// text +='	</tr>';
						// $('#edit_product_promo_list').prepend(text);						
					});

					/*
					Script untuk remove baris produk
					*/
					$( 'body' ).on( "click",'.f_remove_product', function() {					
						$del_id = $(this).prev().val();
						alert($del_id);
						//delete from arr_id						
						for($i = 0; $i < arr_edit_id.length; $i++){
							if(arr_edit_id[$i] == $del_id){
								arr_edit_id[$i] = -1;	//kalo delete maka jadi -1
								alert(arr_edit_id[$i]);
							}
						}
						
						$(this).parent().parent().hide(300, function(){ 
							$(this).remove(); 
						});		
						
					});
					</script>


					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success editButton" data-dismiss="modal">Ya</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('body').on('click', '#edit_promoted_product_input', function(){			
		if($('.f_table_suggestion').hasClass('hidden'))
		{
			$('.f_table_suggestion').removeClass('hidden');
		}
		else
		{
			$('.f_table_suggestion').addClass('hidden');
		}
	});
	
	$('body').on('click', '.f_table_suggestion_item', function(){
		// temp_id = $(this).children().first();
		$('#edit_promoted_product_input').val($(this).children('.f_table_suggestion_item_name').val());
		$('.f_table_suggestion').addClass('hidden');
		//add to temp
		temp_id = $(this).children('.f_table_suggestion_item_id').val();
		// alert(temp_id);			
		temp_name = $(this).children('.f_table_suggestion_item_name').val();
		// alert(temp_name);
		// temp_price = $(this).children('.f_table_suggestion_item_price').val();
		// alert(temp_price);
		// temp_photo = $(this).children('.f_table_suggestion_item_main_photo').val();
		// alert(temp_photo);
	});
	
	$('body').on('click', '.editButton', function(){
		//getpromotionid
		$edit_id = $id;
		$name = $('#edit_name_input').val();
		$amount = $('#edit_amount_input').val();
		$start_date = $('.edit_start_date_input').val();				
		$expired = $('.edit_expired_input').val();					
		$active = 0;
		$products = arr_edit_id;
		
		$data = {
			'id' : $edit_id,
			'name' : $name,
			'amount' : $amount,
			'start_date' : $start_date,
			'expired' : $expired,
			'active' : $active,
			'products' : $products
		};
		json_data = JSON.stringify($data);
		$.ajax({
			type: 'POST',
			url: "{{URL('admin/promotion/editFull')}}",
			data : {
				'json_data' : json_data
			},
			success: function(response){				
				result = JSON.parse(response);
				// alert(JSON.stringify(response));
				if(result.code==201){
					alert(result.status);
					location.reload();
				}				
				else
				{
					alert(result.status);
					alert(result.messages);
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(errorThrown);
			}
		},'json');		
	});
	
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
</script>