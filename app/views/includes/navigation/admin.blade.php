<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--<a class="navbar-brand" href="#">Brand</a>-->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li><a href="{{ URL::to('admin/manage_dashboard') }}"><span class="glyphicon glyphicon-home" style="color:#fff; margin-right:10px;"></span>Dashboard</a></li>
			
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book" style="color:#fff; margin-right:10px;"></span>Catalogue<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{{ URL::to('admin/manage_categories') }}">Manage Category</a></li>
					<li><a href="#">Manage Product</a></li>
					<li><a href="{{ URL::to('admin/manage_attributes') }}">Manage Attribute</a></li>
					<li class="divider"></li>
					<li><a href="{{ URL::to('admin/manage_promotions') }}">Manage Promosi</a></li>
					<li><a href="{{ URL::to('admin/manage_taxes') }}">Manage Tax</a></li>
				</ul>
			</li>

			<li><a href="{{ URL::to('admin/manage_reviews') }}"><span class="glyphicon glyphicon-home" style="color:#fff; margin-right:10px;"></span>Reviews</a></li>
			
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-envelope" style="color:#fff; margin-right:10px;"></span>Shipping and Transaction<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{{ URL::to('admin/manage_shipping') }}"> Manage  Shipping</a></li>
					<li><a href="{{ URL::to('admin/manage_shipping_agent') }}"> Manage Shipping Agent</a></li>	
					<li class="divider"></li>
					<li><a href="{{ URL::to('admin/manage_transaction') }}">Manage  Transaction</a></li>	
					<li><a href="{{ URL::to('admin/manage_order') }}">Manage Order</a></li>	
				</ul>
			</li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-envelope" style="color:#fff; margin-right:10px;"></span>Report<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{{ URL::to('admin/manage_shipping') }}"> Manage  Shipping</a></li>
				</ul>
			</li>
			
			
			<li><a href="{{ URL::to('admin/manage_report') }}"><span class="glyphicon glyphicon-home" style="color:#fff; margin-right:10px;"></span>Report</a></li>
			
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book" style="color:#fff; margin-right:10px;"></span>Customer<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{{ URL::to('admin/manage_customer') }}">Manage Customer</a></li>
					<!--<li><a href="{{ URL::to('admin/get_profile_detail') }}">Profile Detail</a></li>
					<li><a href="{{ URL::to('admin/get_wishlist') }}">Wishlist</a></li>
					<li class="divider"></li>
					<li><a href="{{ URL::to('admin/filter_cust_mgmt') }}">Filter Cust. Management</a></li>
					<li class="divider"></li>
					<li><a href="{{ URL::to('admin/get_search_history') }}">Search History</a></li>
					<li><a href="{{ URL::to('admin/get_trans_history') }}">Transaction History</a></li>-->
				</ul>
			</li>
			
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-volume-up" style="color:#fff; margin-right:10px;"></span>Newsletter<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">Add New Newsletter</a></li>
					
				</ul>
			</li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book" style="color:#fff; margin-right:10px;"></span>Management<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{{ URL::to('test/manage_setting') }}">Set Up</a></li>
					<li><a href="{{ URL::to('test/manage_cms') }}">Manage CMS</a></li>
					<!--<li><a href="{{ URL::to('admin/get_profile_detail') }}">Profile Detail</a></li>
					<li><a href="{{ URL::to('admin/get_wishlist') }}">Wishlist</a></li>
					<li class="divider"></li>
					<li><a href="{{ URL::to('admin/filter_cust_mgmt') }}">Filter Cust. Management</a></li>
					<li class="divider"></li>
					<li><a href="{{ URL::to('admin/get_search_history') }}">Search History</a></li>
					<li><a href="{{ URL::to('admin/get_trans_history') }}">Transaction History</a></li>-->
				</ul>
			</li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-envelope" style="color:#fff; margin-right:10px;"></span>Messages<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{{ URL::to('test/manage_supporting_messages') }}">Supporting Messages</a></li>
					<li><a href="{{ URL::to('test/manage_ticketing') }}">Ticketing</a></li>
				</ul>
			</li>
			
			<li><a href="#">Other Link</a></li>
		</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>