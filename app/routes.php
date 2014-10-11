<?php

Route::get('/tes', 'ProductsController@getTopTenNewProduct');

Route::get('/tes2', function()
{
	$acc = new AccountsController();
	
	$acc->getHistory(5);
});
Route::post('/test_login', ['as' => 'test_login' , 'uses' => 'HomeController@wrapper']);


Route::group(['before' => 'check_token'], function()
{
	//account
		Route::post('/login', ['as' => 'login' , 'uses' => '']);
		Route::post('/register', ['as' => 'register' , 'uses' => '']);
		Route::post('/forgotPass', ['as' => 'forgotPass' , 'uses' => '']);
	//product (+ detail,promo,wishlist,cart)
		Route::get('/product/{:id}', ['as' => 'get.product' , 'uses' => '']);
		Route::get('/product/category/{:category_id}', ['as' => 'get.product.category' , 'uses' => '']);
		Route::get('/product/name/{:name}', ['as' => 'get.product.name' , 'uses' => '']);
		Route::get('/product/top', ['as' => 'get.product.top' , 'uses' => '']);
		Route::get('/product/new', ['as' => 'get.product.new' , 'uses' => '']);
		Route::get('/product/random', ['as' => 'get.product.random' , 'uses' => '']);
		Route::post('/compare', ['as' => 'compare.product' , 'uses' => '']);
	//category
		Route::get('/category', ['as' => 'get.category.list' , 'uses' => '']);
	//slideshow
		Route::get('/slideshow', ['as' => 'get.slideshow.list' , 'uses' => '']);
	//news
		Route::get('/news', ['as' => 'get.news.list' , 'uses' => '']);
		Route::get('/news/{:id}', ['as' => 'get.news.detail' , 'uses' => '']);
	//message
		Route::post('/message', ['as' => 'send.message' , 'uses' => '']);
	//information
		Route::get('/information', ['as' => 'get.information.list' , 'uses' => '']);
		Route::get('/information/{:id}', ['as' => 'get.information.detail' , 'uses' => '']);
	//contact
		Route::get('/contact', ['as' => 'get.contact.list' , 'uses' => '']);
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
		Route::post('/wishlist', ['as' => 'add.wishlist' , 'uses' => '']);
		Route::delete('/wishlist/{:id}', ['as' => 'delete.wishlist' , 'uses' => '']);
	//cart
		Route::get('/classification', ['as' => 'get.classification' , 'uses' => '']);
		Route::post('/cart', ['as' => 'add.cart' , 'uses' => '']);
		Route::put('/cart', ['as' => 'edit.cart.classification' , 'uses' => '']);
		Route::put('/cart/quantity', ['as' => 'edit.cart.quantity' , 'uses' => '']);
		Route::delete('/cart/{:id}', ['as' => 'delete.cart' , 'uses' => '']);
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
		Route::get('/review/{:product_id}', ['as' => 'get.review.product' , 'uses' => '']);
		Route::post('/review', ['as' => 'add.review' , 'uses' => '']);
});

Route::group(['prefix' => 'admin', 'before' => 'auth_admin'], function()
{
    //transaction

});

/* routing sementara buat coba html + css + jquery */
Route::group(array('prefix' => 'test'), function()
{

    // login
	Route::get('/login', function()
	{
		return View::make('pages.admin.login');
	});
	
    // manage order
	Route::get('/manage_order', function()
	{
		return View::make('pages.admin.order.manage_order');
	});
	Route::get('/view_order', function()
	{
		return View::make('pages.admin.order.view_order');
	});
	
    // manage category
	Route::get('/manage_category', function()
	{
		return View::make('pages.admin.category.manage_category');
	});
	Route::get('/add_category', function()
	{
		return View::make('pages.admin.category.add_category');
	});

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

    // Promosi
    Route::get('/manage_transaction', function()
	{
		return View::make('pages.admin.transaction.manage_transaction');
	});


});

