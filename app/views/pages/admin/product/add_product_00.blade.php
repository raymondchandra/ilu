@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
				<div class="container-fluid">
					<div class="row">
						<div class="g-lg-12">
							<div class="s_title_n_control">
								<h3 style="float: left;">
									New Product
								</h3>
								<a href="index.php" class="btn btn-default" style="float: right; margin-top: 20px; margin-right: 10px;">Back</a>
							</div>
							<span class="clearfix"></span>
							<hr></hr>
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Create Product Settings</h3>
								</div>
								<div class="panel-body">
								
									<div class="g-lg-12">
								
											<form class="form-horizontal" role="form">
												<div class="form-group">
													<label for="inputEmail3" class="g-sm-3 control-label">Atrribute Set</label>
													<div class="g-sm-6">
														<select class="form-control">
															<option value="one">One</option>
															<option value="two">Two</option>
															<option value="three">Three</option>
															<option value="four">Four</option>
															<option value="five">Five</option>
														</select>
													</div>
												</div>
											  
												<div class="form-group">
													<label for="inputPassword3" class="g-sm-3 control-label">Tipe Product</label>
													<div class="g-sm-6">
														<select class="form-control">
															<option value="one">One</option>
															<option value="two">Two</option>
															<option value="three">Three</option>
															<option value="four">Four</option>
															<option value="five">Five</option>
														</select>
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
			
			
		