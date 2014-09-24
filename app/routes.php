<?php

Route::group(['before' => 'check_token'], function()
{
    
});

Route::group(['before' => 'customer_check_token'], function()
{
    
});

/* routing sementara buat coba html + css + jquery */
Route::group(array('prefix' => 'test'), function()
{

    // login
	Route::get('/login', function()
	{
		return View::make('pages.admin.login');
	});
	
    // manage product
	Route::get('/manage_product', function()
	{
		return View::make('pages.admin.product.manage_product');
	});

	Route::get('/add_product_00', function()
	{
		return View::make('pages.admin.product.add_product_00');
	});

	Route::get('/add_product_01', function()
	{
		return View::make('pages.admin.product.add_product_01');
	});

    // Second Route
    Route::get('/second', function() {
        return 'Reaper Man';
    });

    // Third Route
    Route::get('/third', function() {
        return 'Lords and Ladies';
    });

});


