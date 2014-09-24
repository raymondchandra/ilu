<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>Admin</title>

		<!--Identity-->
	
	
		<!-- Style -->
		<link href="{{ asset('assets/css/all.css') }}" rel="stylesheet"><!-- {{ asset('assets/css/all.css') }} -->
		<!--<link rel="icon" type="image/png" href="assets/img/favicon.png">--> <!-- {{ asset('assets/img/favicon.png') }} -->
		<script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
		<script src="{{ asset('assets/js/mbf.js') }}"></script>
	</head>
	<body>
			<div class="s_top_header">
				<div class="container-fluid">
					<div class="row">
						<div class="g-lg-12">
							<h2>Ilu Panel</h2>
						</div>
					</div>
				</div>
			</div>
			
			<div class="s_nav_header">
				<div class="container-fluid">
					<div class="row">
						<div class="g-lg-12">
							<nav>
								<ul class="s_top_nav">
									<li>
										<a>Dashboard</a>
									</li>
									<li>
										<a>Catalog</a>
										<ul>
											<li>
												<a>Manage Category</a>
											</li>
											<li>
												<a>Manage Product</a>
											</li>
											<li>
												<a>Manage Attribute</a>
											</li>
											<li>
												<a>Manage Attribute Sets</a>
											</li>
										</ul>
									</li>
									<li>
										<a>Other Nav</a>
									</li>
									<li>
										<a>Other Nav</a>
									</li>
									<li>
										<a>Other Nav</a>
									</li>
									<li>
										<a>Other Nav</a>
									</li>
								</ul>
								
							</nav>
						</div>
					</div>
				</div>
			</div>
			
			<div class="s_content_admin">	
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
									<h3 class="panel-title">General</h3>
								</div>
								<div class="panel-body">
								
									<div class="g-lg-8">
								
											<form class="form-horizontal" role="form">
												<div class="form-group">
													<label class="g-sm-3 control-label">Name</label>
													<div class="g-sm-9">
														<input type="text" class="form-control">				
													</div>
												</div>
												
												<div class="form-group">
													<label class="g-sm-3 control-label">Description</label>
													<div class="g-sm-9">
														<textarea class="form-control" rows="5"></textarea>			
													</div>
												</div>
											  
												<div class="form-group">
													<label class="g-sm-3 control-label">Short Description</label>
													<div class="g-sm-9">
														<textarea class="form-control" rows="5"></textarea>			
													</div>
												</div>
												
												<div class="form-group">
													<label class="g-sm-3 control-label">SKU</label>
													<div class="g-sm-9">
														<input type="text" class="form-control" >				
													</div>
												</div>
												
												<div class="form-group">
													<label class="g-sm-3 control-label">Weight</label>
													<div class="g-sm-9">
														<input type="text" class="form-control" >				
													</div>
												</div>
											  
												<div class="container">
													<div class="row">
														<div class='col-sm-6'>
															<div class="form-group">
																<div class='input-group date' id='datetimepicker1'>
																	<input type='text' class="form-control" />
																	<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
																	</span>
																</div>
															</div>
														</div>
														<script type="text/javascript">
															$(function () {
																$('#datetimepicker1').datetimepicker();
															});
														</script>
													</div>
												</div>
											  
												<div class="form-group">
													<label for="inputPassword3" class="g-sm-3 control-label">Short Description</label>
													<div class="g-sm-9">
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
													<div class="col-sm-offset-2 col-sm-10">
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
			
			</div>
			
		
		
		<script type="text/javascript">
			function updateSize(){
				// Get the dimensions of the viewport
				var width = $(window).width();
				var height = $(window).height();
				var iHeight = $('.irashai').height();
				
				//$('.irashai').width(width);
				//$('.willkommen').width($('.irashai').width()/2);
				//$('.willkommen').height(height);
				//$('body').css('overflow-x','hidden');//.css('overflow-x','visible');
				//$('body').mousewheel(function(event, delta) {
				//	this.scrollLeft -= (delta * 50);
				//	event.preventDefault();
				//});
			};
			$(document).ready(updateSize);
			$(window).resize(updateSize);
		</script>
		<script>
			var timeout    = 500;
			var closetimer = 0;
			var ddmenuitem = 0;

			function jsddm_open()
			{  jsddm_canceltimer();
			   jsddm_close();
			   ddmenuitem = $(this).find('ul').css('visibility', 'visible');}

			function jsddm_close()
			{  if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

			function jsddm_timer()
			{  closetimer = window.setTimeout(jsddm_close, timeout);}

			function jsddm_canceltimer()
			{  if(closetimer)
			   {  window.clearTimeout(closetimer);
				  closetimer = null;}}

			$(document).ready(function()
			{  $('.s_top_nav > li').bind('mouseover', jsddm_open)
			   $('.s_top_nav > li').bind('mouseout',  jsddm_timer)});

			document.onclick = jsddm_close;
		</script>
	</body>
</html>