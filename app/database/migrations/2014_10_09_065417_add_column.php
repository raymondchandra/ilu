<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('promotions', function($table)
		{
		    $table->string('name');

		    $table->dateTime('start_date');
		});

		Schema::table('vouchers', function($table)
		{
		    $table->string('code');

		});

		Schema::table('shipmentDatas', function($table)
		{
		    $table->tinyInteger('deleted');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('promotions', function($table)
		{
		    $table->dropColumn('name');

		});

		Schema::table('vouchers', function($table)
		{
		    $table->dropColumn('code');

		});

		Schema::table('shipmentDatas', function($table)
		{
		    $table->dropColumn('deleted');

		});
	}

}
