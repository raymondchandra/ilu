

<div class="modal fade pop_up_add_promosi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Tambah Promosi Baru</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group has-success has-feedback" id="nama_promosi">
								<label class="col-sm-3 control-label">Name *</label>
								<div class="col-sm-9">
									<input id="new_name_input" type="text" class="form-control" placeholder="Promo Hebat">		
									<span class="glyphicon glyphicon-ok form-control-feedback"></span>		
								</div>
							</div>

							<div class="form-group has-error has-feedback">
								<label class="col-sm-3 control-label">Nilai *</label>
								<div class="col-sm-9">
									<input id="new_amount_input" type="text" onkeypress="return isNumberKey(event)" class="form-control" placeholder="700000">
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
									<input type='text' class="form-control new_start_date_input" id='datepicker00'/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar" >
										</span>
									</span>
								</div>
							</div>
							<script type="text/javascript">
							$(function () {
								$('#datepicker00').datepicker({
									format: 'yyyy-mm-dd'
								 });
							});
							</script>

							<div class="form-group has-error has-feedback">
								<label class="col-sm-4 control-label">Sampai Tanggal</label>
								<div class='input-group date col-sm-7'>
									<input type='text' class="form-control new_expired_input" id='datepicker01'/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar" >
										</span>
									</span>
								</div>
							</div>
							<script type="text/javascript">
							$(function () {								
								 $('#datepicker01').datepicker({
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
							<!--<input onkeypress="search_product()" id="new_promoted_product_input" type="text" class="form-control" placeholder="">-->
							<input id="new_promoted_product_input" type="text" class="form-control" placeholder="">		
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
										</tr>																		
									@endforeach
									<!--<tr id="_product">
										<td width="67"><img src="{{asset('assets/img/1x1.jpg')}}" width="50" class="pull-right"/></td>
										<td>Nama Product</td></a></tr>-->
								</table>	
							</div>	
						</div>
						<div class="col-sm-1">
							<button type="button" class="btn btn-primary " id="f_add_product"><span class="glyphicon glyphicon-plus"></span></button>
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
					var text;
					$( '#f_add_product' ).on( "click", function() {						
						if($('#new_amount_input').val() == '')
						{
							alert('fill amount first!');
						}						
						else
						{									
							if($('#new_promoted_product_input').val() == '')		
							{
								alert('nama product kosong !');
							}
							else
							{								
								// $temp_amount = $('#new_amount_input').val();
								arr_id[arr_id.length] = temp_id;
								// alert(temp_id);	
								$data = {
									'id' : temp_id
								};								
								temp_json_data = JSON.stringify($data);
								// alert(temp_json_data);
								
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
											text +='<td>'+(result.messages['prices'][$i]['price_with_tax']-$('#new_amount_input').val())+'</td>';													
											text +='<td><input type="hidden" value="'+result.messages['id']+'"/>';
											text +='<button type="button" class="btn btn-danger f_remove_product"><span class="glyphicon glyphicon-remove"></span></button></td>';
											text +='</tr>';
											$('#product_promo_list').prepend(text);	
										}										
										
										// alert(result.messages['name']);
										// alert('fak');
									},
									error: function(jqXHR, textStatus, errorThrown){
										alert(errorThrown);
									}
								},'json');
								
								/*
								var text ='<tr>';
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
								$('#product_promo_list').prepend(text);	
								*/
							}	
						}
						
						alert(arr_id.length);
					});

					/*
					Script untuk remove baris produk
					*/
					$( 'body' ).on( "click",'.f_remove_product', function() {					
						$del_id = $(this).prev().val();
						//delete from arr_id						
						for($i = 0; $i < arr_id.length; $i++){
							if(arr_id[$i] == $del_id){
								arr_id[$i] = -1;	//kalo delete maka jadi -1
								alert(arr_id[$i]);
								alert('hapus product id ' +$del_id);
							}
						}
						
						$(this).parent().parent().hide(300, function(){ 
							$(this).remove(); 
						});		
						
					});
					</script>
					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success addButton" data-dismiss="modal">Ya</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>			
			
	
	$('body').on('click', '#new_promoted_product_input', function(){
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
		$('#new_promoted_product_input').val($(this).children('.f_table_suggestion_item_name').val());
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
	
	$('body').on('click', '.addButton', function(){
		$name = $('#new_name_input').val();
		$amount = $('#new_amount_input').val();
		$start_date = $('.new_start_date_input').val();				
		$expired = $('.new_expired_input').val();					
		$active = 0;
		$products = arr_id;
		
		$data = {
			'name' : $name,
			'amount' : $amount,
			'start_date' : $start_date,
			'expired' : $expired,
			'active' : $active,
			'products' : $products
		};
		var json_data = JSON.stringify($data);
		$.ajax({
			type: 'POST',
			url: "{{URL('admin/promotion/addPromotion')}}",
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
	
	// function search_product()
	// {		
		// var search = $('#new_promoted_product_input').val();			
			// var temp_nama = "aaaaaaa";
		// var temp_nama;
			// alert(temp_nama.indexOf(search) > -1);
		
		// $text = '';
		// <?php foreach($list_product as $product){ ?>
			// temp_nama = "<?php echo $product->name; ?>" ;
			// if(temp_nama.indexOf(search) > -1){
				// $text +='<tr class="f_table_suggestion_item">';
				// $text +='<input class="f_table_suggestion_item_id" type="hidden" value="<?php echo $product->id; ?>">';
				// $text +='<input class="f_table_suggestion_item_name" type="hidden" value="<?php echo $product->name; ?>">';
				// if('<?php echo $product->main_photo; ?>' == '')
				// {
					// $text +='<input class="f_table_suggestion_item_main_photo" type="hidden" value="">';
					// $text +='<td width="67"><img src="" width="50" class="pull-right"/></td>';
				// }
				// else
				// {
					// $text +='<input class="f_table_suggestion_item_main_photo" type="hidden" value="<?php echo $product->main_photo; ?>">';
					// $text +='<td width="67"><img src="<?php $product->main_photo; ?>" width="50" class="pull-right"/></td>';
				// }				
				// $text +='<td><?php $product->name; ?></td>';				
				// $text +='</tr>';
			// }	
			// else
			// {
				// do not fill
			// }			
		// <?php } ?>			
		// $('.f_table_suggestion').html($text);		
	// }
</script>