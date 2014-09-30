@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')		
				<div class="container-fluid">
					<div class="row">
						<div class="g-lg-12">
							<div class="s_title_n_control">
								<h3 style="float: left;">
									View Order
								</h3>
								<a href="index.php" class="btn btn-default" style="float: right; margin-top: 20px; margin-right: 10px;">Back</a>
							</div>
							<span class="clearfix"></span>
							<hr></hr>
							
							@include('includes.sidebar.manage_product')
							
							<div class="g-lg-10">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Order Information</h3>
								</div>
								<div class="panel-body">
								
									<div class="g-lg-6">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">Order # 100000056 (the order confirmation email was sent)</h3>
											</div>
											<div class="panel-body">
												<div class="form-group">
													<label class="g-sm-4 control-label">Order Date</label>
													<div class="g-sm-8">
														Mar 28, 2013 8:15:12 AM				
													</div>
												</div>
												<span class="clearfix"></span>
												<div class="form-group">
													<label class="g-sm-4 control-label">Order Status</label>
													<div class="g-sm-8">
														Pending	
														<div class="btn-group">
														  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
															Edit <span class="caret"></span>
														  </button>
														  <ul class="dropdown-menu" role="menu">
															<li><a href="#">Canceled</a></li>
															<li><a href="#">Pending</a></li>
															<li><a href="#">Processing</a></li>
															<li><a href="#">Complete</a></li>
															<li><a href="#">Closed</a></li>
														  </ul>
														</div>
														<button type="button" class="btn btn-success" data-toggle="dropdown">
															OK
														  </button>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="g-lg-6">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">Account Information</h3>
											</div>
											<div class="panel-body">
												<div class="form-group">
													<label class="g-sm-4 control-label">Customer Name</label>
													<div class="g-sm-8">
														Mark Woodland			
													</div>
												</div>
												<span class="clearfix"></span>
												<div class="form-group">
													<label class="g-sm-4 control-label">Email</label>
													<div class="g-sm-8">
														mark@yahoo.com			
													</div>
												</div>
												<span class="clearfix"></span>
												<div class="form-group">
													<label class="g-sm-4 control-label">Customer Group</label>
													<div class="g-sm-8">
														Wholesale			
													</div>
												</div>
											</div>
										</div>
									</div>
									
								
											<form class="form-horizontal" role="form">
												<div class="form-group">
													<label class="g-sm-3 control-label">Name *</label>
													<div class="g-sm-6">
														<input type="text" class="form-control">				
													</div>
													<div class="g-sm-3">
														<span class="btn btn-danger">
															Maaf form harus diisi
														</span>
													</div>
												</div>
												
												<div class="form-group">
													<label class="g-sm-3 control-label">Description *</label>
													<div class="g-sm-6">
														<textarea class="form-control" rows="5"></textarea>			
													</div>
													<div class="g-sm-3">
														<span class="btn btn-danger">
															Maaf form harus diisi
														</span>
													</div>
												</div>
											  
												<div class="form-group">
													<label class="g-sm-3 control-label">Short Description *</label>
													<div class="g-sm-6">
														<textarea class="form-control" rows="5"></textarea>			
													</div>
													<div class="g-sm-3">
														<span class="btn btn-danger">
															Maaf form harus diisi
														</span>
													</div>
												</div>
												
												<div class="form-group">
													<label class="g-sm-3 control-label">Price in IDR *</label>
													<div class="g-sm-6">
														<input type="text" class="form-control">				
													</div>
													<div class="g-sm-3">
														<span class="btn btn-danger">
															Maaf form harus diisi
														</span>
													</div>
												</div>
												
												
												<div class="form-group">
													<label class="g-sm-3 control-label">SKU *</label>
													<div class="g-sm-6">
														<input type="text" class="form-control" >				
													</div>
													<div class="g-sm-3">
														<span class="btn btn-danger">
															Maaf form harus diisi
														</span>
													</div>
												</div>
												
												<div class="form-group">
													<label class="g-sm-3 control-label">Weight</label>
													<div class="g-sm-6">
														<input type="text" class="form-control" >				
													</div>
												</div>
												
												<!-- <div class="form-group">
													<label class="g-sm-3 control-label">New from Date</label>
													<div class='input-group date g-sm-6'>
														<input type='text' class="form-control"  id='datepicker00'/>
														<span class="input-group-addon"><span class="glyphicon glyphicon-calendar" ></span>
														</span>
													</div>
												</div>
												<script type="text/javascript">
													$(function () {
														$('#datepicker00').datepicker();
													});
												</script>
												
												<div class="form-group">
													<label class="g-sm-3 control-label">New to Date</label>
													<div class='input-group date g-sm-6'>
														<input type='text' class="form-control"  id='datepicker01'/>
														<span class="input-group-addon"><span class="glyphicon glyphicon-calendar" ></span>
														</span>
													</div>
												</div>
												<script type="text/javascript">
													$(function () {
														$('#datepicker01').datepicker();
													});
												</script> -->
												
												<div class="form-group">
													<label for="inputPassword3" class="g-sm-3 control-label">Status *</label>
													<div class="g-sm-6">
														<select class="form-control">
															<option value="one">Enabled</option>
															<option value="two">Disabled</option>
														</select>
													</div>
													<div class="g-sm-3">
														<span class="btn btn-danger">
															Maaf form harus diisi
														</span>
													</div>
												</div>
												
												<div class="form-group">
													<label class="g-sm-3 control-label">URL Key</label>
													<div class="g-sm-6">
														<input type="text" class="form-control" >				
													</div>
												</div>
												
												
												<div class="form-group">
													<label for="inputPassword3" class="g-sm-3 control-label">Visibility *</label>
													<div class="g-sm-6">
														<select class="form-control">
															<option value="one">Catalog</option>
															<option value="two">Search</option>
															<option value="two">Catalog, Search</option>
														</select>
													</div>
													<div class="g-sm-3">
														<span class="btn btn-danger">
															Maaf form harus diisi
														</span>
													</div>
												</div>
												
												
												<div class="form-group">
													<label class="g-sm-3 control-label">Color</label>
													<div class="g-sm-6">
														<input type="text" class="form-control" >				
													</div>
												</div>
											  
												<div class="form-group">
													<div class=" g-sm-3 g-sm-push-3">
														<button type="submit" class="btn btn-warning">continue</button>
													</div>
												</div>
											</form>
								
									</div>
							  </div>
							</div>

							
						</div>
					</div>
				</div>
@stop