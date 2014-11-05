<?php
use Carbon\Carbon;

Route::get('/tes', 'ProductsController@getById');

// Route::get('/tes', 'ProductsController@getAll');

Route::get('/tes_news', 'NewsManagementController@getNews');
Route::get('/tes_news/{id}', 'NewsManagementController@getOneNews');

Route::get('/tesview', function (){
	return View::make('pages.admin.product.manage_product');
});

Route::get('/tes2', function()
{
		$respond = array();
		$report = Transaction::where('paid','=','1')->get();
		$bulan = date('n') -5;
		$tahun = date('Y');
		$idx = 1;
		$bulanAkhir = 6;
		$hasil = array();
		while($idx <= $bulanAkhir)
		{
			$tempHasil = 0;
			$tempBulan = Carbon::parse($tahun."-".$bulan."-01")->format('n');
			$tempBulanHsl = Carbon::parse($tahun."-".$bulan."-01")->format('F');
			$tempTahun = Carbon::parse($tahun."-01-01")->format('Y');
			foreach($report as $key)
			{
				$dd = $key->updated_at;
				$tahunCek = Carbon::parse($dd)->format('Y');
				$bulanCek = Carbon::parse($dd)->format('n');
				if($tahunCek == $tempTahun)
				{
					if($bulanCek == $tempBulan)
					{
						$tempHasil = $tempHasil + $key->total_price;
					}
				}
			}
			$hasil[] = array('tanggal'=>$tempBulan, 'penjualan' => $tempHasil,'ket'=>'sixmonth','tgl'=>$tempBulanHsl.' '.$tempTahun);
			$idx = $idx + 1;
			$bulan = $bulan +1;
		}
		$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		echo $respond['status'];
});
Route::post('/test_login', ['as' => 'test_login' , 'uses' => 'HomeController@wrapper']);



Route::group(['before' => 'check_token'], function()
{
	//account
		Route::post('/login', ['as' => 'login' , 'uses' => '']);
		Route::post('/register', ['as' => 'register' , 'uses' => '']);
		Route::post('/forgotPass', ['as' => 'forgotPass' , 'uses' => '']);
	//product (+ detail,promo,wishlist,cart)
		Route::get('/product/{id}', ['as' => 'get.product' , 'uses' => '']);
		Route::get('/product/category/{:category_id}', ['as' => 'get.product.category' , 'uses' => '']);
		Route::get('/product/name/{:name}', ['as' => 'get.product.name' , 'uses' => '']);
		Route::get('/product/top', ['as' => 'get.product.top' , 'uses' => '']);
		Route::get('/product/new', ['as' => 'get.product.new' , 'uses' => '']);
		Route::get('/product/random', ['as' => 'get.product.random' , 'uses' => '']);
		Route::post('/compare', ['as' => 'compare.product' , 'uses' => '']);
	//category
		Route::get('/category', ['as' => 'get.category.list' , 'uses' => '']);
	//slideshow
		Route::get('/slideshow', ['as' => 'get.slideshow.list' , 'uses' => 'GalleryController@getSlideshow']);
	//news
		Route::get('/news', ['as' => 'get.news.list' , 'uses' => '']);
		Route::get('/news/{:id}', ['as' => 'get.news.detail' , 'uses' => '']);
	//message
		Route::post('/message', ['as' => 'send.message' , 'uses' => '']);
	//information
		Route::get('/information', ['as' => 'get.information.list' , 'uses' => 'InformationController@getAll']);
		Route::get('/information/{id}', ['as' => 'get.information.detail' , 'uses' => 'InformationController@getById']);
	//contact
		Route::get('/contact', ['as' => 'get.contact.list' , 'uses' => '']);
	//seo
		Route::get('/seo', ['as' => 'get.seo' , 'uses' => 'SeosController@getAll']);
});

Route::group(['prefix' => 'user', 'before' => 'auth_user'], function()
{
	//account
		Route::put('/password', ['as' => 'changePassword' , 'uses' => '']);
		Route::post('/logout', ['as' => 'logout' , 'uses' => '']);
	//profile & mobile phone
		Route::get('/profile', ['as' => 'get.profile' , 'uses' => '']);
		Route::put('/profile', ['as' => 'edit.profile' , 'uses' => '']);
	//address & phone
		Route::post('/address', ['as' => 'add.address' , 'uses' => '']);
		Route::put('/address', ['as' => 'edit.address' , 'uses' => '']);
		Route::delete('/address/{:id}', ['as' => 'delete.address' , 'uses' => '']);
	//wishlist
		Route::get('/wishlist', ['as' => 'get.wishlist' , 'uses' => 'WishlistsController@getWishList']);
		Route::post('/wishlist', ['as' => 'add.wishlist' , 'uses' => 'WishlistsController@insert']);
		Route::delete('/wishlist/{:product_id}', ['as' => 'delete.wishlist' , 'uses' => 'WishlistsController@delete']);
	//cart
		Route::get('/classification', ['as' => 'get.classification' , 'uses' => '']);
		Route::post('/cart', ['as' => 'add.cart' , 'uses' => '']);
		Route::put('/cart', ['as' => 'edit.cart.classification' , 'uses' => '']);
		Route::put('/cart/quantity', ['as' => 'edit.cart.quantity' , 'uses' => '']);
		Route::delete('/cart/{id}', ['as' => 'delete.cart' , 'uses' => '']);
	//voucher
		Route::post('/checkVoucher', ['as' => 'check.voucher' , 'uses' => '']);
	//order
		Route::get('/order', ['as' => 'get.order.list' , 'uses' => '']);
		Route::post('/order', ['as' => 'add.order' , 'uses' => '']);
	//payment confirm
		Route::get('/bank', ['as' => 'get.bank.list' , 'uses' => '']);
		Route::get('/shipment', ['as' => 'get.shipment.list' , 'uses' => '']);
		Route::post('/payment', ['as' => 'add.payment' , 'uses' => '']);
	//review
		Route::get('/review/{product_id}', ['as' => 'get.review.product' , 'uses' => '']);
		Route::post('/review', ['as' => 'add.review' , 'uses' => '']);
	//supportMsg
		Route::get('/supportMsg/{ticket_id}', ['as' => 'get.supportMsg.ticket' , 'uses' => 'SupportMsgsController@getByTicket']);
		Route::post('/supportMsg', ['as' => 'add.supportMsg' , 'uses' => 'SupportMsgsController@insert']);
});

Route::group(['prefix' => 'admin', 'before' => 'auth_admin'], function()
{

	//-------------------------------------------ATTRIBUTE VIEW ADMIN-------------------------------------------		
	Route::get('manage_attributes', ['as' => 'viewAttributesManagement', 'uses' => 'AttributesManagementController@view_admin_attribute']);
	Route::get('/attribute/{id}', ['as' => 'attribute_detail', 'uses' => 'AttributesManagementController@view_detail_attribute']);
	Route::post('/attribute/addAttribute', ['as' => 'attribute.addAttribute', 'uses' => 'AttributesManagementController@addAttribute']);
	Route::post('/attribute/editName', ['as' => 'attribute.editName', 'uses' => 'AttributesManagementController@editName']);	
	Route::post('/attribute/deleteAttribute', ['as' => 'attribute.deleteAttribute', 'uses' => 'AttributesManagementController@deleteAttribute']);	
	
	//-------------------------------------------CATEGORY VIEW ADMIN-------------------------------------------	
	Route::get('manage_categories', ['as' => 'viewCategoriesManagement', 'uses' => 'CategoriesManagementController@view_admin_category']);
	Route::get('/category/{id}', ['as' => 'category_detail', 'uses' => 'CategoriesManagementController@view_detail_category']);
	Route::post('/category/addCategory', ['as' => 'category.addCategory', 'uses' => 'CategoriesManagementController@addCategory']);
	Route::post('/category/editFull', ['as' => 'category.editFull', 'uses' => 'CategoriesManagementController@editFull']);	
	Route::post('/category/deleteCategory', ['as' => 'category.deleteCategory', 'uses' => 'CategoriesManagementController@deleteCategory']);	

	//-------------------------------------------TAX VIEW ADMIN-------------------------------------------	
	Route::get('/manage_taxes', ['as' => 'viewTaxesManagement', 'uses' => 'TaxesManagementController@view_admin_tax']);
	Route::get('/tax/{id}', ['as' => 'tax_detail', 'uses' => 'TaxesManagementController@view_detail_tax']);
	Route::post('/tax/addTax', ['as' => 'tax.addTax', 'uses' => 'TaxesManagementController@addTax']);
	Route::post('/tax/editFull', ['as' => 'tax.editFull', 'uses' => 'TaxesManagementController@editFull']);	
	Route::post('/tax/deleteTax', ['as' => 'tax.deleteTax', 'uses' => 'TaxesManagementController@deleteTax']);	
	
	//-------------------------------------------REVIEW VIEW ADMIN-------------------------------------------	
	Route::get('/manage_reviews', ['as' => 'viewReviewsManagement', 'uses' => 'ReviewsManagementController@view_admin_review']);
	Route::get('/review/{id}', ['as' => 'review_detail', 'uses' => 'ReviewsManagementController@view_detail_review']);
	Route::post('/review/editApproved', ['as' => 'review.editApproved', 'uses' => 'ReviewsManagementController@editApproved']);
	
	//-------------------------------------------PROMOTION VIEW ADMIN-------------------------------------------
	Route::get('/manage_promotions', ['as' => 'viewPromotionsManagement', 'uses' => 'PromotionsManagementController@view_admin_promotion']);
	Route::get('/promotion/getProductById', ['as' => 'promotion.getProductById', 'uses' => 'PromotionsManagementController@getProductById']);
	Route::get('/promotion/{id}', ['as' => 'promotion_detail', 'uses' => 'PromotionsManagementController@view_detail_promotion']);
	Route::post('/promotion/addPromotion', ['as' => 'promotion.addPromotion', 'uses' => 'PromotionsManagementController@addPromotion']);
	Route::post('/promotion/editFull', ['as' => 'promotion.editFull', 'uses' => 'PromotionsManagementController@editFull']);	
	Route::delete('/promotion/deletePromotion', ['as' => 'promotion.deletePromotion', 'uses' => 'PromotionsManagementController@deletePromotion']);
	
	//-------------------------------------------PRODUCT VIEW ADMIN-------------------------------------------
	Route::get('/manage_products', ['as' => 'viewProductsManagement', 'uses' => 'ProductsManagementController@view_admin_product']);	
	Route::get('product/{id}', ['as' => 'product_detail', 'uses' => 'ProductsManagementController@view_detail_product']);
	// Route::get('product/info/{id}', ['as' => 'product_detail_info', 'uses' => 'ProductsManagementController@view_detail_info']);
	// Route::get('product/gallery/{id}', ['as' => 'product_detail_gallery', 'uses' => 'ProductsManagementController@view_detail_gallery']);
	Route::post('/product/addProduct', ['as' => 'product.addProduct', 'uses' => 'ProductsManagementController@addProduct']);
	// Route::post('/product/editInfo', ['as' => 'product.editInfo', 'uses' => 'ProductsManagementController@editInfo']);
		Route::post('/product/editProductNo', ['as' => 'product.editProducyNo', 'uses' => 'ProductsManagementController@editProductNo']);
		Route::post('/product/editName', ['as' => 'product.editName', 'uses' => 'ProductsManagementController@editName']);
		Route::post('/product/editDescription', ['as' => 'product.editDescription', 'uses' => 'ProductsManagementController@editDescription']);
		Route::post('/product/editCategoryId', ['as' => 'product.editCategoryId', 'uses' => 'ProductsManagementController@editCategoryId']);
		Route::post('/product/editPromotionId', ['as' => 'product.editPromotionId', 'uses' => 'ProductsManagementController@editPromotionId']);
		Route::post('/product/editPrice', ['as' => 'product.editPrice', 'uses' => 'ProductsManagementController@editPrice']);		
		Route::post('/product/editGallery', ['as' => 'product.editGallery', 'uses' => 'ProductsManagementController@editGallery']);
	Route::post('/product/deleteProduct', ['as' => 'product.deleteProduct', 'uses' => 'ProductsManagementController@deleteProduct']);	
	
	//ooooooooooooooooooooooooooooooooooooooKERJAAN DAVIDoooooooooooooooooooooooooooooooooooooooo
	Route::get('/manage_customer', ['as'=>'david.viewCustomerManagement','uses' => 'CustomerManagementController@view_cust_mgmt']);
	
	Route::get('/get_wishlist', ['as'=>'david.getWishlist','uses' => 'WishlistsController@getWishListByAccountId']);
	
	Route::get('/get_search_history', ['as'=>'david.getSearchHistory','uses' => 'LogsController@getSearchLogByAccountId']);

	Route::get('/get_trans_history', ['as'=>'david.getTransHistory','uses' => 'TransactionsController@getByAccountId']);
	
	Route::get('/get_profile_detail', ['as'=>'david.getProfDet','uses' => 'ProfilesController@myGetById']);
	
	Route::get('/filter_cust_mgmt', ['as'=>'david.getFilteredCustomer','uses' => 'ProfilesController@myGetById']);
	
	Route::get('/get_new_voucher_code', ['as'=>'david.getNewVoucherCode','uses' => 'VouchersController@generateVoucherNumber']);
	
	Route::get('/get_voucher_list', ['as'=>'david.getVoucherList','uses' => 'VouchersController@getByAccountId']);
	
	Route::post('/post_new_voucher', ['as'=>'david.postNewVoucher','uses' => 'VouchersController@insert']);
	
	Route::post('/post_new_active', ['as'=>'david.postNewActive','uses' => 'AccountsController@changeActive']);
	
	Route::get('/admin_sign_in', ['before'=>'force.ssl','as'=>'david.adminSignIn','uses' => 'AccountsController@adminLogin']);
	
	Route::get('/logout', ['as'=>'david.logout','uses' => 'AccountsController@postLogout']);
	
	Route::get('/login', array('as'=>'ilu.main.login','before'=>'force.ssl',function()
	{
		return View::make('pages.admin.login');
	}));

    // dashboard
	Route::get('/dashboard', array('as'=>'ilu.main.dashboard',function()
	{
		return View::make('pages.admin.dashboard');
	}));
	
	// Route::get('/bernico', function(){return View::make('pages.admin.tax.manage_tax');});
	
	//category 
		// Route::get('/category', ['as' => 'category', 'uses' => 'CategoriesController@view_main_category']);
			// Route::get('/categoryIdAsc', ['as' => 'categoryIdAsc', 'uses' => 'CategoriesController@view_main_categoryIdAsc']);
			// Route::get('/categoryIdDesc', ['as' => 'categoryIdDesc', 'uses' => 'CategoriesController@view_main_categoryIdDesc']);
			// Route::get('/categoryNameAsc', ['as' => 'categoryNameAsc', 'uses' => 'CategoriesController@view_main_categoryNameAsc']);
			// Route::get('/categoryNameDesc', ['as' => 'categoryNameDesc', 'uses' => 'CategoriesController@view_main_categoryNameDesc']);
			// Route::get('/categoryParentNameAsc', ['as' => 'categoryParentNameAsc', 'uses' => 'CategoriesController@view_main_categoryParentNameAsc']);
			// Route::get('/categoryParentNameDesc', ['as' => 'categoryParentNameDesc', 'uses' => 'CategoriesController@view_main_categoryParentNameDesc']);
		// Route::get('/category/{id}', ['as' => 'category_detail', 'uses' => 'CategoriesController@view_detail_category']);
		// Route::get('/searchCategory', ['as' => 'searchCategory', 'uses' => 'CategoriesController@view_search_category']);
		// Route::post('/category/editFull', ['as' => 'category.editFull', 'uses' => 'CategoriesController@editFull']);
		// Route::post('/category/addCategory', ['as' => 'category.addCategory', 'uses' => 'CategoriesController@addCategory']);
	
	//review
		// Route::get('/review', ['as' => 'review', 'uses' => 'ReviewsController@view_main_review']);
			// Route::get('/reviewProductNoAsc', ['as' => 'reviewProductNoAsc', 'uses' => 'ReviewsController@view_main_reviewProductNoAsc']);
			// Route::get('/reviewProductNoDesc', ['as' => 'reviewProductNoDesc', 'uses' => 'ReviewsController@view_main_reviewProductNoDesc']);
			// Route::get('/reviewProductNameAsc', ['as' => 'reviewProductNameAsc', 'uses' => 'ReviewsController@view_main_reviewProductNameAsc']);
			// Route::get('/reviewProductNameDesc', ['as' => 'reviewProductNameDesc', 'uses' => 'ReviewsController@view_main_reviewProductNameDesc']);
			// Route::get('/reviewTextAsc', ['as' => 'reviewTextAsc', 'uses' => 'ReviewsController@view_main_reviewTextAsc']);
			// Route::get('/reviewTextDesc', ['as' => 'reviewTextDesc', 'uses' => 'ReviewsController@view_main_reviewTextDesc']);
			// Route::get('/reviewRatingAsc', ['as' => 'reviewRatingAsc', 'uses' => 'ReviewsController@view_main_reviewRatingAsc']);
			// Route::get('/reviewRatingDesc', ['as' => 'reviewRatingDesc', 'uses' => 'ReviewsController@view_main_reviewRatingDesc']);
			// Route::get('/reviewApprovedAsc', ['as' => 'reviewApprovedAsc', 'uses' => 'ReviewsController@view_main_reviewApprovedAsc']);
			// Route::get('/reviewApprovedDesc', ['as' => 'reviewApprovedDesc', 'uses' => 'ReviewsController@view_main_reviewApprovedDesc']);
		// Route::get('/review/{id}', ['as' => 'review_detail', 'uses' => 'ReviewsController@view_detail_review']);
		// Route::get('/searchReview', ['as' => 'searchReview', 'uses' => 'ReviewsController@view_search_review']);
		// Route::post('/review/editApproved', ['as' => 'review.editApproved', 'uses' => 'ReviewsController@editApproved']);
		
	//tax
		// Route::get('/tax', ['as' => 'tax', 'uses' => 'TaxesController@view_main_tax']);			
		// Route::get('/tax/{id}', ['as' => 'tax_detail', 'uses' => 'TaxesController@view_detail_tax']);
		// Route::get('/searchTax', ['as' => 'searchTax', 'uses' => 'TaxesController@view_search_tax']);
		// Route::post('/tax/editFull', ['as' => 'tax.editFull', 'uses' => 'TaxesController@editFull']);
		// Route::post('/tax/addTax', ['as' => 'tax.addTax', 'uses' => 'TaxesController@addTax']);			
	
	//product 
		// Route::get('/product', ['as' => 'product' , 'uses' => 'ProductsController@view_main_product']);
		// Route::get('/product/{id}', ['as' => 'product_detail' , 'uses' => 'ProductsController@view_detail_product']);
		
		// Route::get('/filter', ['as' => 'admin.filter' , 'uses' => 'ProductsController@coba_sort']);
	
    //transaction

	//information
		Route::post('/information', ['as' => 'add.information' , 'uses' => 'InformationController@insert']);
    	Route::put('/information/{id}', ['as' => 'edit.information' , 'uses' => 'InformationController@updateFull']);
    	Route::delete('/information/{id}', ['as' => 'delete.information' , 'uses' => 'InformationController@delete']);
    //newsletter
    	Route::get('/newsletter', ['as' => 'get.newsletter.list' , 'uses' => 'TemplatesController@getAll']);
    	Route::get('/newsletter/{id}', ['as' => 'get.newsletter.detail' , 'uses' => 'TemplatesController@getById']);
    	Route::get('/newsletter/filter', ['as' => 'get.newsletter.filter' , 'uses' => 'TemplatesController@getByTitleSubject']);
    	Route::post('/newsletter', ['as' => 'add.newsletter' , 'uses' => 'TemplatesController@insert']);
    	Route::put('/newsletter/{id}', ['as' => 'edit.newsletter' , 'uses' => 'TemplatesController@updateFull']);
    	Route::post('/sendnewsletter', ['as' => 'send.newsletter' , 'uses' => 'TemplatesController@sendNewsletter']);
    	Route::delete('/newsletter/{id}', ['as' => 'delete.newsletter' , 'uses' => 'TemplatesController@delete']);
    //slideshow
    	Route::post('/postSlideShow', ['as' => 'add.slideshow' , 'uses' => 'GalleryController@upload_slideshow']);
    	Route::post('/editSlideShow', ['as' => 'edit.slideshow' , 'uses' => 'GalleryController@update_slideshow']);
    	Route::delete('/slideshow/{id}', ['as' => 'delete.slideshow' , 'uses' => 'GalleryController@delete']);
    //seo
		Route::get('/seo', ['as' => 'get.seo' , 'uses' => 'SeosController@getAll']);
    	Route::post('/seo', ['as' => 'add.seo' , 'uses' => 'SeosController@insert']);
    	Route::put('/seo/{id}', ['as' => 'edit.seo' , 'uses' => 'SeosController@updateFull']);
    	Route::delete('/seo/{id}', ['as' => 'delete.seo' , 'uses' => 'SeosController@delete']);
		
	//news management
		Route::get('/news', ['as' => 'get.news' , 'uses' => 'NewsManagementController@getNews']);
		Route::post('/news', ['as' => 'post.news' , 'uses' => 'NewsManagementController@postNews']);
		Route::put('/news/{id}', ['as' => 'put.news' , 'uses' => 'NewsManagementController@updateNews']);
	
    //supportMsg
		Route::get('/supportMsg/{ticket_id}', ['as' => 'get.supportMsg.ticket' , 'uses' => 'SupportMsgsController@getByTicket']);
		Route::post('/supportMsg', ['as' => 'add.supportMsg' , 'uses' => 'SupportMsgsController@insert']);

		
		
	//SHIPPING
	Route::get('/manage_shipping', ['as'=>'jeffry.getShipping', 'uses' => 'ShippingManagementController@view_shipping_mgmt']);
	
	Route::get('/get_detail_shipment', ['as'=>'jeffry.getDetailShip','uses' => 'ShipmentsController@getById']);
	
	Route::put('/put_status_shipment' , ['as'=>'jeffry.putStatusShipment','uses' => 'ShipmentsController@updateStatus']);
	
	//SHIPPING AGENT
	Route::get('/manage_shipping_agent', ['as'=>'jeffry.getShippingAgent','uses' => 'ShippingAgentManagementController@view_shipping_agent_mgmt']);
	
	Route::get('/get_detail_shipment_agent', ['as'=>'jeffry.getDetailShipAgent','uses' => 'ShipmentDatasController@getById']);
	
	Route::delete('/delete_shipment_agent', ['as' => 'jeffry.deleteShipmentAgent' , 'uses' => 'ShipmentDatasController@delete']);
	
	Route::post('/add_shipment_agent', ['as' => 'jeffry.addShipmentAgent' , 'uses' => 'ShipmentDatasController@insert']);
	
	Route::post('/add_shipment_agent_excel', ['as' => 'jeffry.addShipmentAgentExcel' , 'uses' => 'ShipmentDatasController@insertExcel']);
	
	Route::put('/put_price_shipment_agent' , ['as'=>'jeffry.putPriceShipAgent','uses' => 'ShipmentDatasController@updatePrice']);
	
	//TRANSAKSI
	Route::get('/manage_transaction', ['as'=>'jeffry.getTransaction', 'uses' => 'TransactionManagementController@view_transaction_mgmt']);
	
	Route::get('/get_detail_transaction', ['as'=>'jeffry.getDetailTransaction','uses' => 'TransactionsController@getDetail']);
	
	Route::put('/put_status_transaction' , ['as'=>'jeffry.putStatusTransaction','uses' => 'TransactionsController@updateStatus']);
	
	Route::put('/put_paid_transaction' , ['as'=>'jeffry.putPaidTransaction','uses' => 'TransactionsController@updatePaid']);
	
	Route::put('/put_shippingNumber_transaction' , ['as'=>'jeffry.putShippingNumberTransaction','uses' => 'ShipmentsController@updateResiNumber']);
	
	//ORDER
	Route::get('/manage_order', ['as' =>'jeffry.getOrder', 'uses' => 'OrderManagementController@view_order_mgmt']);
	
	Route::put('/put_status_order' , ['as'=>'jeffry.putStatusOrder','uses' => 'OrdersController@updateStatus']);
	
	Route::get('/manage_order_detail', ['as' =>'jeffry.getOrderDetail', 'uses' => 'OrdersController@getDetail']);
	
	//REPORT
	Route::get('/manage_report', ['as' =>'jeffry.getReport', 'uses' => 'ReportingManagementController@view_reporting_mgmt_day']);
	
	//DASHBOARD
	Route::get('/manage_dashboard', ['as' =>'jeffry.getDashboard', 'uses' => 'DashboardsManagementController@view_dashboard_mgmt']);

});

/* routing sementara buat coba html + css + jquery */
Route::group(array('prefix' => 'test'), function()
{

    // login
	Route::get('/login', array('as'=>'ilu.test.login','before'=>'force.ssl',function()
	{
		return View::make('pages.admin.login');
	}));

    // dashboard
	Route::get('/dashboard', array('as'=>'ilu.test.dashboard',function()
	{
		return View::make('pages.admin.dashboard');
	}));
	
    // manage order
	Route::get('/manage_order', function()
	{
		return View::make('pages.admin.order.manage_order');
	});
	
    // manage category
	// Route::get('/manage_category', function()
	// {
		// return View::make('pages.admin.category.manage_category');
	// });
	// Route::get('/add_category', function()
	// {
		// return View::make('pages.admin.category.add_category');
	// });

    // manage product
	Route::get('/manage_product', function()
	{
		return View::make('pages.admin.product.manage_product');
	});

	Route::get('/add_product_setup', function()
	{
		return View::make('pages.admin.product.add_product_setup');
	});

	Route::get('/add_product_general', function()
	{
		return View::make('pages.admin.product.add_product_general');
	});
	
	Route::get('/add_product_images', function()
	{
		return View::make('pages.admin.product.add_product_images');
	});

    // Manage Attribute
    // Route::get('/manage_attribute', function()
	// {
		// return View::make('pages.admin.attribute.manage_attribute');
	// });

    // Newsletter
    Route::get('/manage_newsletter', function()
	{
		return View::make('pages.admin.newsletter.manage_newsletter');
	});


    // Tax
    Route::get('/manage_tax', function()
	{
		return View::make('pages.admin.tax.manage_tax');
	});

    // Promosi
    Route::get('/manage_promosi', function()
	{
		return View::make('pages.admin.promosi.manage_promosi');
	});

    // Transaction
    Route::get('/manage_transaction', function()
	{
		return View::make('pages.admin.transaction.manage_transaction');
	});

    // Shipping
    Route::get('/manage_shipping', function()
	{
		return View::make('pages.admin.shipping.manage_shipping');
	});

    // Shipping Agent
    Route::get('/manage_shipping_agent', function()
	{
		return View::make('pages.admin.shipping.manage_shipping_agent');
	});

    // Customer
    Route::get('/manage_customer', function()
	{
		return View::make('pages.admin.customer.manage_customer');
	});	
	
	
	
	Route::get('/manage_customer_david', ['as'=>'david.viewCustomerManagement','uses' => 'CustomerManagementController@view_cust_mgmt']);
	
	Route::get('/get_wishlist', ['as'=>'david.getWishlist','uses' => 'WishlistsController@getWishListByAccountId']);
	
	Route::get('/get_search_history', ['as'=>'david.getSearchHistory','uses' => 'LogsController@getSearchLogByAccountId']);

	Route::get('/get_trans_history', ['as'=>'david.getTransHistory','uses' => 'TransactionsController@getByAccountId']);
	
	Route::get('/get_profile_detail', ['as'=>'david.getProfDet','uses' => 'ProfilesController@myGetById']);
	
	Route::get('/filter_cust_mgmt', ['as'=>'david.getFilteredCustomer','uses' => 'ProfilesController@myGetById']);
	
	
	
    // Review
    Route::get('/manage_review', function()
	{
		return View::make('pages.admin.review.manage_review');
	});

    // Report
    Route::get('/manage_report', function()
	{
		return View::make('pages.admin.report.manage_report');
	});

    // CMS
    Route::get('/manage_cms', function()
	{
		return View::make('pages.admin.cms.manage_cms');
	});






    // Messages support
    Route::get('/manage_supporting_messages', function()
	{
		return View::make('pages.admin.messages.manage_supporting_messages');
	});


    // Messages ticket
    Route::get('/manage_ticketing', function()
	{
		return View::make('pages.admin.messages.manage_ticketing');
	});

    // 404
    Route::get('/404', function()
	{
		return View::make('pages.admin.other.404');
	});







    // email 00
    Route::get('/email_00', function()
	{
		return View::make('pages.admin.email_template.forgot_password');
	});
    // email 01
    Route::get('/email_01', function()
	{
		return View::make('pages.admin.email_template.message');
	});
    // email 02
    Route::get('/email_02', function()
	{
		return View::make('pages.admin.email_template.new_registran');
	});
    // email 03
    Route::get('/email_03', function()
	{
		return View::make('pages.admin.email_template.news');
	});
    // email 04
    Route::get('/email_04', function()
	{
		return View::make('pages.admin.email_template.promo');
	});
    // email 05
    Route::get('/email_05', function()
	{
		return View::make('pages.admin.email_template.voucher');
	});


});

