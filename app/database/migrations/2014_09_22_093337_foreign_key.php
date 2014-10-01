<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKey extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('accounts', function($table)
		{
		    $table->foreign('profile_id')->references('id')->on('profiles');
		});
		Schema::table('phones', function($table)
		{
		    $table->foreign('profile_id')->references('id')->on('profiles');
		});
		Schema::table('addresses', function($table)
		{
		    $table->foreign('profile_id')->references('id')->on('profiles');
		});
		Schema::table('products', function($table)
		{
		    $table->foreign('category_id')->references('id')->on('categories');
		    $table->foreign('promotion_id')->references('id')->on('promotions');
		});
		Schema::table('categories', function($table)
		{
		    $table->foreign('parent_category')->references('id')->on('categories');
		});
		Schema::table('prices', function($table)
		{
		    $table->foreign('attr_id')->references('id')->on('attributes');
		    $table->foreign('product_id')->references('id')->on('products');
		    $table->foreign('tax_id')->references('id')->on('taxes');
		});
		Schema::table('transactions', function($table)
		{
		    $table->foreign('account_id')->references('id')->on('accounts');
		    $table->foreign('voucher_id')->references('id')->on('vouchers');
		    $table->foreign('shipment_id')->references('id')->on('shipments');
		});
		Schema::table('orders', function($table)
		{
		    $table->foreign('price_id')->references('id')->on('prices');
		    $table->foreign('transaction_id')->references('id')->on('transactions');
		});
		Schema::table('galleries', function($table)
		{
		    $table->foreign('product_id')->references('id')->on('products');
		});
		Schema::table('reviews', function($table)
		{
		    $table->foreign('product_id')->references('id')->on('products');
		});
		Schema::table('supportTickets', function($table)
		{
		    $table->foreign('account_id')->references('id')->on('accounts');
		});
		Schema::table('supportMsgs', function($table)
		{
		    $table->foreign('ticket_id')->references('id')->on('supportTickets');
		    $table->foreign('account_id')->references('id')->on('accounts');
		});
		Schema::table('vouchers', function($table)
		{
		    $table->foreign('account_id')->references('id')->on('accounts');
		});
		Schema::table('wishlists', function($table)
		{
		    $table->foreign('account_id')->references('id')->on('accounts');
		    $table->foreign('product_id')->references('id')->on('products');
		});
		Schema::table('logs', function($table)
		{
		    $table->foreign('account_id')->references('id')->on('accounts');
		});
		Schema::table('information', function($table)
		{
		    $table->foreign('edited_by')->references('id')->on('accounts');
		});
		Schema::table('payments', function($table)
		{
		    $table->foreign('transaction_id')->references('id')->on('transactions');
		    $table->foreign('bank_id')->references('id')->on('banks');
		});
		Schema::table('carts', function($table)
		{
		    $table->foreign('account_id')->references('id')->on('accounts');
		    $table->foreign('price_id')->references('id')->on('prices');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('carts', function($table)
		{
		    $table->dropForeign('carts_account_id_foreign');
		    $table->dropForeign('carts_price_id_foreign');
		});
		Schema::table('payments', function($table)
		{
		    $table->dropForeign('payments_bank_id_foreign');
		    $table->dropForeign('payments_transaction_id_foreign');
		});
		Schema::table('information', function($table)
		{
		    $table->dropForeign('information_edited_by_foreign');
		});
		Schema::table('logs', function($table)
		{
		    $table->dropForeign('logs_account_id_foreign');
		});
		Schema::table('wishlists', function($table)
		{
		    $table->dropForeign('wishlists_product_id_foreign');
		    $table->dropForeign('wishlists_account_id_foreign');
		});
		Schema::table('vouchers', function($table)
		{
		    $table->dropForeign('vouchers_account_id_foreign');
		});
		Schema::table('supportMsgs', function($table)
		{
		    $table->dropForeign('supportmsgs_account_id_foreign');
		    $table->dropForeign('supportmsgs_ticket_id_foreign');
		});
		Schema::table('supportTickets', function($table)
		{
		    $table->dropForeign('supporttickets_account_id_foreign');
		});
		Schema::table('reviews', function($table)
		{
		    $table->dropForeign('reviews_product_id_foreign');
		});
		Schema::table('galleries', function($table)
		{
		    $table->dropForeign('galleries_product_id_foreign');
		});
		Schema::table('orders', function($table)
		{
		    $table->dropForeign('orders_transaction_id_foreign');
		    $table->dropForeign('orders_product_id_foreign');
		});
		Schema::table('transactions', function($table)
		{
		    $table->dropForeign('transactions_shipment_id_foreign');
		    $table->dropForeign('transactions_account_id_foreign');
		    $table->dropForeign('transactions_voucher_id_foreign');
		});
		Schema::table('prices', function($table)
		{
		    $table->dropForeign('prices_tax_id_foreign');
		    $table->dropForeign('prices_attr_id_foreign');
		    $table->dropForeign('prices_product_id_foreign');
		});
		Schema::table('categories', function($table)
		{
		    $table->dropForeign('categories_parent_category_foreign');
		});
		Schema::table('products', function($table)
		{
		    $table->dropForeign('products_category_id_foreign');
		    $table->dropForeign('products_promotion_id_foreign');
		});
		Schema::table('addresses', function($table)
		{
		    $table->dropForeign('addresses_profile_id_foreign');
		});
		Schema::table('phones', function($table)
		{
		    $table->dropForeign('phones_profile_id_foreign');
		});
		Schema::table('accounts', function($table)
		{
			$table->dropForeign('accounts_profile_id_foreign');
		});
		
	}

}
