<?php

Route::get('/tes', 'CategoriesController@test');

Route::get('/tesview', function (){
	return View::make('pages.admin.product.manage_product');
});

Route::get('/tes2', function()
{
	return Hash::make('secret');
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
		Route::get('/review', ['as' => 'review', 'uses' => 'ReviewsController@view_main_review']);
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
		Route::get('/review/{id}', ['as' => 'review_detail', 'uses' => 'ReviewsController@view_detail_review']);
		Route::get('/searchReview', ['as' => 'searchReview', 'uses' => 'ReviewsController@view_search_review']);
		Route::post('/review/editApproved', ['as' => 'review.editApproved', 'uses' => 'ReviewsController@editApproved']);
		
	//tax
		Route::get('/tax', ['as' => 'tax', 'uses' => 'TaxesController@view_main_tax']);			
		Route::get('/tax/{id}', ['as' => 'tax_detail', 'uses' => 'TaxesController@view_detail_tax']);
		Route::get('/searchTax', ['as' => 'searchTax', 'uses' => 'TaxesController@view_search_tax']);
		Route::post('/tax/editFull', ['as' => 'tax.editFull', 'uses' => 'TaxesController@editFull']);
		Route::post('/tax/addTax', ['as' => 'tax.addTax', 'uses' => 'TaxesController@addTax']);			
	
	//product 
		Route::get('/product', ['as' => 'product' , 'uses' => 'ProductsController@view_main_product']);
		Route::get('/product/{id}', ['as' => 'product_detail' , 'uses' => 'ProductsController@view_detail_product']);
		
		Route::get('/filter', ['as' => 'admin.filter' , 'uses' => 'ProductsController@coba_sort']);
	
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
    //supportMsg
		Route::get('/supportMsg/{ticket_id}', ['as' => 'get.supportMsg.ticket' , 'uses' => 'SupportMsgsController@getByTicket']);
		Route::post('/supportMsg', ['as' => 'add.supportMsg' , 'uses' => 'SupportMsgsController@insert']);


});

/* routing sementara buat coba html + css + jquery */
Route::group(array('prefix' => 'test'), function()
{

    // login
	Route::get('/login', function()
	{
		return View::make('pages.admin.login');
	});

    // dashboard
	Route::get('/dashboard', function()
	{
		return View::make('pages.admin.dashboard');
	});
	
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
	
	Route::get('/get_new_voucher_code', ['as'=>'david.getNewVoucherCode','uses' => 'VouchersController@generateVoucherNumber']);
	
	Route::get('/get_voucher_list', ['as'=>'david.getVoucherList','uses' => 'VouchersController@getByAccountId']);
	
	Route::post('/post_new_voucher', ['as'=>'david.postNewVoucher','uses' => 'VouchersController@insert']);
	
	Route::get('/admin_sign_in', ['before'=>'force.ssl','as'=>'david.adminSignIn','uses' => 'AccountsController@adminLogin']);
	
	Route::get('/manage_shipping_jeffry', ['uses' => 'ShippingManagementController@view_shipping_mgmt']);
	
	Route::get('/manage_shipping_agent_jeffry', ['uses' => 'ShippingAgentManagementController@view_shipping_agent_mgmt']);
	
	Route::get('/get_detail_shipment_agent', ['as'=>'jeffry.getDetailShipAgent','uses' => 'ShipmentDatasController@getById']);
	
	Route::put('/put_price_shipment_agent' , ['as'=>'jeffry.putPriceShipAgent','uses' => 'ShipmentDatasController@updatePrice']);
	
	Route::get('/manage_transaction_jeffry', ['uses' => 'TransactionManagementController@view_transaction_mgmt']);
	
	Route::get('/get_detail_transaction', ['as'=>'jeffry.getDetailTransaction','uses' => 'TransactionsController@getDetail']);
	
	Route::put('/put_status_transaction' , ['as'=>'jeffry.putStatusTransaction','uses' => 'TransactionsController@updateStatus']);
	
	Route::put('/put_paid_transaction' , ['as'=>'jeffry.putPaidTransaction','uses' => 'TransactionsController@updatePaid']);
	
	Route::get('/manage_order_jeffry', ['uses' => 'OrderManagementController@view_order_mgmt']);
	
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


});

