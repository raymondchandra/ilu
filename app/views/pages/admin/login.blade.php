@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
				<div class="container-fluid">
					<div class="row ">
						<div class="g-lg-12">
							<div class="s_title_n_control">
								<h3 style="float: left;">
									Login
								</h3>
								<!--<a href="index.php" class="btn btn-default" style="float: right; margin-top: 20px; margin-right: 10px;">Back</a> -->
							</div>
							<span class="clearfix"></span>
							<hr></hr>
							<div class="s_tbl s_set_height_window">
								<div class="s_cl">
									<div class="g-lg-6 g-lg-push-3">
									
										<p class="bg-danger" style="padding-top: 10px; padding-bottom: 10px; margin-bottom: 20px;">Maaf username/password anda salah!</p>
										
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">Login to Admin Panel</h3>
											</div>
											<div class="panel-body">
												<form class="form-horizontal" role="form">
													<div class="form-group">
														<label for="inputEmail3" class="g-sm-3 control-label">Username/Email</label>
														<div class="g-sm-6">
															<input type="text" class="form-control" placeholder="Username/Email">	
														</div>
													</div>
												  
													<div class="form-group">
														<label for="inputPassword3" class="g-sm-3 control-label">Password</label>
														<div class="g-sm-6">
															<input type="password" class="form-control" placeholder="Password">	
														</div>
													</div>
												  
													<div class="form-group">
														<div class=" g-sm-3 g-sm-push-3">
															<button type="submit" class="btn btn-warning">Login</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			@stop