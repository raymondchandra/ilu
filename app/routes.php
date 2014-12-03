<?php
use Carbon\Carbon;

//ROUTE FRONT END
Route::get('/', function (){
	return View::make('pages.frontend.frontend');
});

Route::get('/tes', function()
{
	$priceController = new PricesController();
	
	return $priceController;
});

// Route::get('/tes', 'ProductsController@getAll');

Route::get('/tes_news', 'NewsManagementController@getNews');
Route::get('/tes_news/{id}', 'NewsManagementController@getOneNews');

Route::get('/tesview', function (){
	return View::make('pages.admin.product.manage_product');
});

Route::get('/tes2', function()
{
		//$stat = 'On-shipping';
		//$date1 = '01-November-2014';
		//$date2 = '03-November-2014';
		$paid = 1;
		$bln = 'October';
		$thn = '2014';
		$blnTemp = Carbon::parse($bln.'-01-'.$thn)->format('n');

		
		$order = Transaction::where(DB::raw('MONTH(transactions.updated_at)'), '=', $blnTemp)->where(DB::raw('YEAR(transactions.updated_at)'), '=', $thn)->join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('transactions.paid','=',$paid)->get(array('transactions.id','profiles.full_name','transactions.invoice','transactions.status','transactions.total_price','transactions.paid'));
		
		if(count($order) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$order);
		}
		echo $respond['messages'];
});
Route::post('/test_login', ['as' => 'test_login' , 'uses' => 'HomeController@wrapper']);



Route::group(['before' => 'check_token'], function()
{
	//account
		Route::post('/login', ['as' => 'login' , 'uses' => '']);
		Route::post('/register', ['as' => 'register' , 'uses' => '']);
		Route::post('/forgotPass', ['as' => 'forgotPass' , 'uses' => '']);
	//product (+ detail,promo,wishlist,cart)
		Route::get('/product/{id}', ['as' => 'get.product' , 'uses' => 'ProductsController@ws_getById']);
		Route::get('/product/category/{category_id}', ['as' => 'get.product.category' , 'uses' => 'ProductsController@ws_getByCategoryId']);
		Route::get('/product/name/{name}', ['as' => 'get.product.name' , 'uses' => 'ProductsController@ws_getByName']);
		Route::get('/product/top', ['as' => 'get.product.top' , 'uses' => '']);
		Route::get('/product/new', ['as' => 'get.product.new' , 'uses' => 'ProductsController@ws_getTopTenNewProduct']);
		Route::get('/product/random', ['as' => 'get.product.random' , 'uses' => '']);
		Route::get('/compare', ['as' => 'compare.product' , 'uses' => 'ProductsController@ws_compare']);
	//category
		Route::get('/category', ['as' => 'get.category.list' , 'uses' => 'CategoriesController@ws_getCategory']);
	//slideshow
		Route::get('/slideshow', ['as' => 'get.slideshow.list' , 'uses' => 'SlideshowManagementController@get_all_slideshow']);
	//news
		Route::get('/news', ['as' => 'get.news.list' , 'uses' => 'NewsManagementController@getNews']);
		Route::get('/news/{id}', ['as' => 'get.news.detail' , 'uses' => '']);
	//message
		Route::post('/message', ['as' => 'send.message' , 'uses' => '']);
	//information
		Route::get('/information', ['as' => 'get.information.list' , 'uses' => 'InformationController@getAll']);
		Route::get('/information/{id}', ['as' => 'get.information.detail' , 'uses' => 'InformationController@getById']);
	//contact
		Route::get('/contact', ['as' => 'get.contact.list' , 'uses' => '']);
	//seo
		Route::get('/seo', ['as' => 'get.seo' , 'uses' => 'SeosManagementController@get_all_seos']);
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
		Route::get('/wishlist', ['as' => 'get.wishlist' , 'uses' => 'WishlistsController@ws_getWishlist']);
		Route::post('/wishlist', ['as' => 'add.wishlist' , 'uses' => 'WishlistsController@ws_insert']);
		Route::delete('/wishlist/{:product_id}', ['as' => 'delete.wishlist' , 'uses' => 'WishlistsController@ws_delete']);
	//cart
		Route::get('/classification', ['as' => 'get.classification' , 'uses' => '']);
		Route::post('/cart', ['as' => 'add.cart' , 'uses' => '']);
		Route::put('/cart', ['as' => 'edit.cart.classification' , 'uses' => '']);
		Route::put('/cart/quantity', ['as' => 'edit.cart.quantity' , 'uses' => 'ws_updateQuantity']);
		Route::delete('/cart/{id}', ['as' => 'delete.cart' , 'uses' => 'CartsController@ws_delete']);
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
		Route::get('/review/{product_id}', ['as' => 'get.review.product' , 'uses' => 'ReviewsController@ws_getReviewProduct']);
		Route::post('/review', ['as' => 'add.review' , 'uses' => 'ReviewsController@ws_insert']);
	//supportMsg
		Route::get('/supportMsg/{ticket_id}', ['as' => 'get.supportMsg.ticket' , 'uses' => 'SupportMsgsController@getByTicket']);
		Route::post('/supportMsg', ['as' => 'add.supportMsg' , 'uses' => 'SupportMsgsController@insert']);	
});

Route::group(['prefix' => 'admin', 'before' => 'auth_admin'], function()
{
	//DASHBOARD
	Route::get('/', ['as' =>'jeffry.getDashboard', 'uses' => 'DashboardsManagementController@view_dashboard_mgmt']);
	Route::get('/manage_dashboard', ['as' =>'jeffry.getDashboard', 'uses' => 'DashboardsManagementController@view_dashboard_mgmt']);
	
	
	//-------------------------------------------ATTRIBUTE VIEW ADMIN-------------------------------------------		
	Route::get('manage_attributes', ['as' => 'viewAttributesManagement', 'uses' => 'AttributesManagementController@view_admin_attribute']);
	Route::get('/attribute/{id}', ['as' => 'attribute_detail', 'uses' => 'AttributesManagementController@view_detail_attribute']);
	Route::post('/attribute/addAttribute', ['as' => 'attribute.addAttribute', 'uses' => 'AttributesManagementController@addAttribute']);
	Route::post('/attribute/editName', ['as' => 'attribute.editName', 'uses' => 'AttributesManagementController@editName']);	
	Route::post('/attribute/deleteAttribute', ['as' => 'attribute.deleteAttribute', 'uses' => 'AttributesManagementController@deleteAttribute']);	
	
	//-------------------------------------------CATEGORY VIEW ADMIN-------------------------------------------	
	Route::get('/manage_categories', ['as' => 'viewCategoriesManagement', 'uses' => 'CategoriesManagementController@view_admin_category']);
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
	Route::delete('/product/deletePrice', ['as' => 'product.deletePrice', 'uses' => 'ProductsManagementController@deletePrice']);
	Route::post('/product/additionalPrices', ['as' => 'product.additionalPrices', 'uses' => 'ProductsManagementController@additionalPrices']);
	
	//-------------------------------------------PAYMENTPROFF VIEW ADMIN-------------------------------------------
	Route::get('/manage_payment_proof', ['as' => 'viewPaymentProffsManagement', 'uses' => 'PaymentProffsManagementController@view_admin_paymentproff']);
	
	//ooooooooooooooooooooooooooooooooooooooKERJAAN DAVIDoooooooooooooooooooooooooooooooooooooooo
	Route::get('/manage_newsletter', function()
	{
		return View::make('pages.admin.newsletter.manage_newsletter');
	});
	Route::post('/sendNewsLetter', ['as' => 'david.sendNewsLetter', 'uses' => 'NewsLetterController@send_news_letter']);
	Route::get('/getTopTenNewProduct', ['as' => 'getTopTenNewProduct', 'uses' => 'ProductsController@getTopTenNewProduct']);
	Route::get('/getProductFromNewestPromotion', ['as' => 'getProductFromNewestPromotion', 'uses' => 'PromotionsController@getProductFromNewestPromotion']);
	
	Route::get('/manage_customer', ['as'=>'david.viewCustomerManagement','uses' => 'CustomerManagementController@view_cust_mgmt']);
	
	Route::get('/get_wishlist', ['as'=>'david.getWishlist','uses' => 'WishlistsController@getWishListByAccountId']);
	
	Route::get('/get_cart', ['as'=>'david.getCart','uses' => 'CartsController@getCartByAccountId']);
	
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
		Route::get('/information', ['as' => 'get.information' , 'uses' => 'InformationManagementController@get_information']);
		Route::post('/information', ['as' => 'add.information' , 'uses' => 'InformationManagementController@insert_information']);
    	Route::put('/information/{id}', ['as' => 'edit.information' , 'uses' => 'InformationController@updateFull']);
    	Route::delete('/information/{id}', ['as' => 'delete.information' , 'uses' => 'InformationManagementController@delete']);
		
	//detail info
		Route::get('/edit_informasi_detail/{id}', ['as' => 'get.information_detail' , 'uses' => 'InformationManagementController@view_detail']);
		Route::post('/information_content/{id}', ['as' => 'post.information_detail' , 'uses' => 'InformationManagementController@insert_information_content']);
		Route::put('/information_content/{id}', ['as' => 'put.information_detail' , 'uses' => 'InformationManagementController@update_article']);
		Route::delete('/information_content/{id}', ['as' => 'delete.information_detail' , 'uses' => 'InformationManagementController@delete_information_content']);
	
    //newsletter
    	Route::get('/newsletter', ['as' => 'get.newsletter.list' , 'uses' => 'TemplatesController@getAll']);
    	Route::get('/newsletter/{id}', ['as' => 'get.newsletter.detail' , 'uses' => 'TemplatesController@getById']);
    	Route::get('/newsletter/filter', ['as' => 'get.newsletter.filter' , 'uses' => 'TemplatesController@getByTitleSubject']);
    	Route::post('/newsletter', ['as' => 'add.newsletter' , 'uses' => 'TemplatesController@insert']);
    	Route::put('/newsletter/{id}', ['as' => 'edit.newsletter' , 'uses' => 'TemplatesController@updateFull']);
    	Route::post('/sendnewsletter', ['as' => 'send.newsletter' , 'uses' => 'TemplatesController@sendNewsletter']);
    	Route::delete('/newsletter/{id}', ['as' => 'delete.newsletter' , 'uses' => 'TemplatesController@delete']);
    //slideshow
		Route::get('/slideshow', ['as' => 'get.slideshow' , 'uses' => 'SlideshowManagementController@get_all_slideshow']);
		Route::post('/slideshow', ['as' => 'post.slideshow' , 'uses' => 'SlideshowManagementController@insert']);
		Route::post('/slideshow/{id}', ['as' => 'post.slideshow' , 'uses' => 'SlideshowManagementController@update']);
		Route::delete('/slideshow/{id}', ['as' => 'delete.slideshow' , 'uses' => 'SlideshowManagementController@delete']);
    //seo
		Route::get('/seo', ['as' => 'get.seo' , 'uses' => 'SeosManagementController@get_all_seos']);
    	//Route::post('/seo', ['as' => 'add.seo' , 'uses' => 'SeosController@insert']);
    	Route::put('/seo/{id}', ['as' => 'edit.seo' , 'uses' => 'SeosManagementController@edit_seos']);
    	//Route::delete('/seo/{id}', ['as' => 'delete.seo' , 'uses' => 'SeosController@delete']);
		
	//news management
		Route::get('/news', ['as' => 'get.news' , 'uses' => 'NewsManagementController@getNews']);
		Route::post('/news', ['as' => 'post.news' , 'uses' => 'NewsManagementController@postNews']);
		Route::put('/news/{id}', ['as' => 'put.news' , 'uses' => 'NewsManagementController@updateNews']);
	
    //supportMsg
		Route::get('/supportMsg/{ticket_id}', ['as' => 'get.supportMsg.ticket' , 'uses' => 'SupportMsgsController@getByTicket']);
		Route::post('/supportMsg', ['as' => 'add.supportMsg' , 'uses' => 'SupportMsgsController@insert']);

	//banks
		Route::get('/banks', ['as' => 'get.banks' , 'uses' => 'BankManagementController@get_all']);
		Route::post('/banks', ['as' => 'post.banks' , 'uses' => 'BankManagementController@insert']);
		Route::put('/banks/{id}', ['as' => 'put.banks' , 'uses' => 'BankManagementController@update']);
		Route::delete('/banks/{id}', ['as' => 'delete.banks' , 'uses' => 'BankManagementController@delete']);
		
	//company info
		Route::get('/company', ['as' => 'get.company' , 'uses' => 'CompanyInfoManagementController@get_company_info']);
		Route::post('/company', ['as' => 'post.company' , 'uses' => 'CompanyInfoManagementController@insert']);
		
	//messages
		Route::get('/messages', ['as' => 'get.messages' , 'uses' => 'MessagesManagementController@get_all_messages']);
		Route::post('/messages', ['as' => 'get.messages' , 'uses' => 'MessagesManagementController@send_email']);
		
	//ticket messages
		Route::get('/ticket_messages', ['as' => 'get.ticket_messages' , 'uses' => 'MessagesManagementController@get_all_ticket_messages']);
		
		Route::get('/ticket_messages/{id}', ['as' => 'get.ticket_messages' , 'uses' => 'MessagesManagementController@get_ticket_messages']);
	
		Route::put('/ticket_messages/{id}', ['as' => 'put.ticket_messages' , 'uses' => 'MessagesManagementController@update_solve']);
		
		
		
		Route::post('/ticket_messages', ['as' => 'post.ticket_messages' , 'uses' => 'MessagesManagementController@send_email']);	
		
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
	
	
	Route::get('/top_ten_product', ['as' =>'jeffry.top10product', 'uses' => 'TransactionsController@getTopTenProduct']);
	
	//jeje
	Route::get('/manage_report_produk', ['as' =>'jeffry.getReportProduk', 'uses' => 'ReportingManagementController@view_reporting_product']);

	Route::get('/manage_report_produk1month', ['as' =>'jeffry.getReportProduk1Month', 'uses' => 'TransactionsController@getMostCurrentProdukOneMonth']);
	
	Route::get('/manage_report_produk1month_detail', ['as' =>'jeffry.getReportProduk1MonthDetail', 'uses' => 'TransactionsController@getDetailMostCurrentProdukOneMonth']);
	
	Route::get('/manage_report_produk_range', ['as' =>'jeffry.getReportProdukRange', 'uses' => 'TransactionsController@getMostCurrentProdukRange']);
	
	Route::get('/manage_report_produk2_1month', ['as' =>'jeffry.getReportProduk21Month', 'uses' => 'TransactionsController@getPenjualanProdukOneMonth']);
	
	Route::get('/manage_report_produk2_range', ['as' =>'jeffry.getReportProduk2Range', 'uses' => 'TransactionsController@getPenjualanProdukRange']);
	
	Route::get('/manage_report_produk2_1month_detail', ['as' =>'jeffry.getReportProduk21MonthDetail', 'uses' => 'TransactionsController@getDetailPenjualanProduk']);
	
	Route::get('/manage_report_produk2_range_detail', ['as' =>'jeffry.getReportProduk2RangeDetail', 'uses' => 'TransactionsController@getDetailPenjualanProdukRange']);
	
	Route::get('/manage_report_pengiriman_month', ['as' =>'jeffry.getReportPengirimanMonth', 'uses' => 'TransactionsController@getStatusMonth']);
	
	Route::get('/manage_report_pengiriman_month_detail', ['as' =>'jeffry.getReportPengirimanMonthDetail', 'uses' => 'TransactionsController@getDetailPopUp']);
	
	Route::get('/manage_report_pengiriman', ['as' =>'jeffry.getReportPengiriman', 'uses' => 'ReportingManagementController@view_reporting_pengiriman']);
	
	Route::get('/manage_report_pengiriman_range', ['as' =>'jeffry.getReportPengirimanRange', 'uses' => 'TransactionsController@getStatusRange']);
	
	Route::get('/manage_report_all_pengiriman_month', ['as' =>'jeffry.getReportAllPengirimanMonth', 'uses' => 'TransactionsController@getAllStatusMonth']);
	
	Route::get('/manage_report_all_pengiriman_range', ['as' =>'jeffry.getReportAllPengirimanRange', 'uses' => 'TransactionsController@getAllStatusRange']);
	
	Route::get('/manage_report_pembayaran', ['as' =>'jeffry.getReportPembayaran', 'uses' => 'ReportingManagementController@view_reporting_pembayaran']);
	
	Route::get('/manage_report_pembayaran_month', ['as' =>'jeffry.getReportPembayaranMonth', 'uses' => 'TransactionsController@getPaidMonth']);
	
	Route::get('/manage_report_pembayaran_range', ['as' =>'jeffry.getReportPembayaranRange', 'uses' => 'TransactionsController@getPaidRange']);
	
	Route::get('/manage_report_all_pembayaran_month', ['as' =>'jeffry.getReportAllPembayaranMonth', 'uses' => 'TransactionsController@getAllPaidMonth']);
	
	Route::get('/manage_report_all_pembayaran_range', ['as' =>'jeffry.getReportAllPembayaranRange', 'uses' => 'TransactionsController@getAllPaidRange']);

	Route::get('/manage_report_pembayaran_month_detail', ['as' =>'jeffry.getReportPembayaranMonthDetail', 'uses' => 'TransactionsController@getDetailPopUp']);
	
	
	 Route::get('/manage_cms', function()
	{
		return View::make('pages.admin.cms.manage_cms');
	});
    // Setting
    Route::get('/manage_setting', function()
	{
		return View::make('pages.admin.cms.manage_setting');
	});

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
	
	
	
	Route::post('/sendNewsLetter', ['as' => 'david.sendNewsLetter', 'uses' => 'NewsLetterController@send_news_letter']);
	
	Route::get('/getTopTenNewProduct', ['as' => 'getTopTenNewProduct', 'uses' => 'ProductsController@getTopTenNewProduct']);
	
	Route::get('/getProductFromNewestPromotion', ['as' => 'getProductFromNewestPromotion', 'uses' => 'PromotionsController@getProductFromNewestPromotion']);
	
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



	//jeje send
	Route::post('/sendTransaction', ['as' => 'jeffry.sendEmailTrans', 'uses' => 'TransactionsController@send_progress']);



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

    // Report
    Route::get('/manage_report_produk', function()
	{
		return View::make('pages.admin.report.manage_report_produk');
	});
    // Report
    Route::get('/manage_report_pengiriman', function()
	{
		return View::make('pages.admin.report.manage_report_pengiriman');
	});
    // Report
    Route::get('/manage_report_pembayaran', function()
	{
		return View::make('pages.admin.report.manage_report_pembayaran');
	});

    // manage_payment_proof
    Route::get('/manage_payment_proof', function()
	{
		return View::make('pages.admin.payment_proof.manage_payment_proof');
	});

    // manage_payment_proof
   

	
	
	Route::get('/print', ['as' =>'jeffry.getPrintPdf', 'uses' => 'TransactionsController@showPDF']);
	
	Route::get('/aaa', function()
{
    $html = '<html><body>'
            . '<div class="modal-header printHead">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabelByr">Detail Pembayaran [object Object] No Invoice 3184966</h4>
			</div> <div class="row">
						<div class="col-sm-12"><!-- col-sm-5 -->
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>
											Nama Produk
										</th>
										<th>
											Foto Produk
										</th>
										<th>
											Category Produk
										</th>
										<th>
											Attribut Produk
										</th>
										<th>
											Qty.
										</th>
										<th>
											Harga satuan
										</th>
										<th>
											Subtotal
										</th>
									</tr>
								</thead>
								<tbody class="isiTab"><tr><td>et</td><td><img width="100" height="100" src=""></td><td>Jonatan Cronin</td><td>omnis - in</td><td>6</td><td>Rp 100,-</td><td>Rp 600,-</td></tr><tr><td>et</td><td><img width="100" height="100" src=""></td><td>Harvey Weber</td><td>voluptas - commodi</td><td>15</td><td>Rp 1.000,-</td><td>Rp 15.000,-</td></tr></tbody>
							</table>			
						</div>
					</div>'
            . '</body></html>';
    return PDF::load($html, 'A4', 'portrait')->show();
});
	
});

