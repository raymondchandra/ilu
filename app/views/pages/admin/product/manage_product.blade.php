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
									Manage Product
								</h3>
								<a href="add_product_00" class="btn btn-success" style="float: right; margin-top: 20px;">+ Add Product</a>
							</div>
							<span class="clearfix"></span>
							<hr></hr>
							
							<div>
								<table class="table table-striped table-hover ">
									<thead>
										<tr>
											<th></th>
											<th>ID</th>
											<th>Nama</th>
											<th>Tipe</th>
											<th>Attribute Set</th>
											<th>SKU</th>
											<th>Harga</th>
											<th>Qty</th>
											<th>Visibility</th>
											<th>Status</th>
											<th>Website</th>
											<th>Edit</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										for ($i=0; $i<=30; $i++) {
										  ?>
										<tr> 
											<td><input type="checkbox"></td>
											<td><?php echo($i); ?></td>
											<td>Barang bagus</td>
											<td>Pakaian</td>
											<td>Set atribut pakaian</td>
											<td>242342</td>
											<td>300000</td>
											<td>90</td>
											<td>catalog</td>
											<td>enables</td>
											<td>-</td>
											<td><a class="btn btn-warning btn-xs">Edit</a></td>
										</tr> 
										  <?php
										} 
										?>
										
									</tbody>
								</table>
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