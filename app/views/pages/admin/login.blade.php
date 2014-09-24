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
			
			
			<div class="s_content_admin">	
				<div class="container-fluid">
					<div class="row">
						<div class="g-lg-12">
							<div class="s_title_n_control">
								<h3 style="float: left;">
									Login
								</h3>
								<!--<a href="index.php" class="btn btn-default" style="float: right; margin-top: 20px; margin-right: 10px;">Back</a> -->
							</div>
							<span class="clearfix"></span>
							<hr></hr>
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Login to Admin Panel</h3>
								</div>
								<div class="panel-body">
								
									<div class="g-lg-8">
								
											<form class="form-horizontal" role="form">
												<div class="form-group">
													<label for="inputEmail3" class="g-sm-3 control-label">Username/Email</label>
													<div class="g-sm-9">
														<input type="text" class="form-control" placeholder="Username/Email">	
													</div>
												</div>
											  
												<div class="form-group">
													<label for="inputPassword3" class="g-sm-3 control-label">Password</label>
													<div class="g-sm-9">
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