@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			
				<div class="s_title_n_control">
					<h3 style="float: left;">
						Manage Newsletter
					</h3>
				</div>
				<span class="clearfix"></span>
				<hr></hr>
				
				<div>
					<div class="row">
						<div class="col-lg-6">
							<h2>Preview</h2>
							<div class="panel panel-default">
							  <div class="panel-body">
								@include('pages.admin.email_template.promo')
							  </div>
							</div>
							
					</div>
						<div class="col-lg-6">
							<h2>Editor</h2>
							<div>
								<label class="radio-inline">
								  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Promo
								</label>
								<label class="radio-inline">
								  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> New Product
								</label>
								<label class="radio-inline">
								  <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> Top Selling Product
								</label>
							</div>
							<div>
							<link href="{{ asset('assets/js/jqte/jquery-te-1.4.0.css') }}" rel="stylesheet">
							<script src="{{ asset('assets/js/jqte/jquery-te-1.4.0.min.js') }}"></script>
								<textarea class="f_te"></textarea>
								<button type="button" id="send-button" class="btn btn-success">Send</button>
								<script>
									$("textarea").jqte({change: function()
									{ 
										//var x = $("textarea").jqteVal('sadasd');
										$('#email_body_content').html($('.jqte_editor').html());
									}});
									
									$('body').on('click','#inlineRadio1',function()
									{
										
										$.ajax({
											type: 'GET',
											url: '{{URL::route('getProductFromNewestPromotion')}}',
											data: {	
												
											},
											success: function(response){
												if(response['code'] == '404')
												{
													alert(response['code']);
												}
												else
												{
													$length = 6;
													if(response['messages']['products'].length < 6)
													{
														$length = response['messages']['products'].length;
													}
													
													for ( var i = 0; i < $length; i++ ) {
														//alert(response['messages']['products'][i].prices[0].amount);
														$('#caption_'+(i+1)).text(response['messages']['products'][i].name);
														
														$('#price_'+(i+1)).text("Rp. " + response['messages']['products'][i].prices[0].amount+",-");
														
														//main_photo
														
														$('#img_'+(i+1)).attr('src',"../../" + response['messages']['products'][i].main_photo);
													}
													
													for(var j = $length-1 ; j< 6 ; j++)
													{
														$('#td_'+(j+2)).addClass('hidden');
													}
													
												}
											},error: function(xhr, textStatus, errorThrown){
												alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
												alert("responseText: "+xhr.responseText);
											}
										},'json');
									});
									
									$('body').on('click','#inlineRadio2',function()
									{
										
										$.ajax({
											type: 'GET',
											url: '{{URL::route('getTopTenNewProduct')}}',
											data: {	
												
											},
											success: function(response){
												if(response['code'] == '404')
												{
													alert(response['code']);
												}
												else
												{
													$length = 6;
													if(response['messages'].length < 6)
													{
														$length = response['messages'].length;
													}
													
													for ( var i = 0; i < $length; i++ ) {
														//alert(response['messages']['products'][i].prices[0].amount);
														$('#caption_'+(i+1)).text(response['messages'][i].name);
														
														$('#price_'+(i+1)).text("Rp. " + response['messages'][i].prices[0].amount+",-");
														
														//main_photo
														
														$('#img_'+(i+1)).attr('src',"../../" + response['messages'][i].main_photo);
													}
													
													for(var j = $length-1 ; j< 6 ; j++)
													{
														$('#td_'+(j+2)).addClass('hidden');
													}
													
												}
											},error: function(xhr, textStatus, errorThrown){
												alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
												alert("responseText: "+xhr.responseText);
											}
										},'json');	
									});
									
									$('body').on('click','#inlineRadio3',function()
									{
										
										$.ajax({
											type: 'GET',
											url: '{{URL::route('jeffry.top10product')}}',
											data: {	
												
											},
											success: function(response){
												if(response['code'] == '404')
												{
													
												}
												else
												{
													$length = 6;
													if(response['messages'].length < 6)
													{
														$length = response['messages'].length;
													}
													
													for ( var i = 0; i < $length; i++ ) {
														//alert(response['messages']['products'][i].prices[0].amount);
														$('#caption_'+(i+1)).text(response['messages'][i].product.name);
														
														$('#price_'+(i+1)).text("Rp. " + response['messages'][i].product.prices[0].amount+",-");
														
														//main_photo
														
														$('#img_'+(i+1)).attr('src',"../../" + response['messages'][i].product.main_photo);
													}
													
													for(var j = $length-1 ; j< 6 ; j++)
													{
														$('#td_'+(j+2)).addClass('hidden');
													}
													
												}
											},error: function(xhr, textStatus, errorThrown){
												alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
												alert("responseText: "+xhr.responseText);
											}
										},'json');
										
										
									});
									
									$('body').on('click','#send-button',function()
									{
										$body = $('.panel-body').html();
										alert($body);
										
										$.ajax({
											type: 'POST',
											url: "{{URL::route('david.sendNewsLetter')}}",
											data: {	
												'body':$body
											},
											success: function(response){
												if(response['code'] == '404')
												{
													alert(response['code']);
												}
												else
												{
													alert('success');
													
												}
											},error: function(xhr, textStatus, errorThrown){
												alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
												alert("responseText: "+xhr.responseText);
											}
										},'json');
									});
									//email_body_content
									//jqte_editor
									
								</script>
							</div>
						</div>
					</div>
					
					
					<!--
					<button class="btn btn-success" style="float: right; margin-top: 20px;" data-toggle="modal" data-target=".pop_up_add_newsletter">+ Add New Tax</button>
					<table class="table table-striped table-hover table-condensed table-bordered">
						<thead class="table-bordered">
							<tr>
								<th class="table-bordered">
									<a href="javascript:void(0)">Judul</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Subject</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									
								</th>
						</thead>
						<thead>
							<tr>
								<td><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								
								<td width=""><a class="btn btn-primary btn-xs">Filter</a></td>
							</tr>
						</thead>
						<tbody>
							<?php 
							for ($i=0; $i<=30; $i++) {
							  ?>
							<tr> 
								
								<td>Judul</td>
								<td>Subject</td>
								
								<td>
									<button class="btn btn-info btn-xs" data-toggle="modal" data-target=".pop_up_view_newsletter">View</button>
									<button class="btn btn-warning btn-xs" data-toggle="modal" data-target=".pop_up_edit_newsletter">Edit</button>
									<!-- Button trigger modal class ".alertYesNo" -->
									<!--
									<button class="btn btn-danger btn-xs" data-toggle="modal" data-target=".alertYesNo">Delete</button>
								</td>
							</tr> 
							  <?php
							} 
							?>
							
						</tbody>
					</table>
					-->
				</div>
				
			</div>
		</div>
	</div>
	
	@include('includes.modals.alertYesNo')
	@include('pages.admin.newsletter.pop_up_add_newsletter')
	@include('pages.admin.newsletter.pop_up_edit_newsletter')
	@include('pages.admin.newsletter.pop_up_view_newsletter')

@stop