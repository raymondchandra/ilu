<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemakeShipment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shipments', function($table)
		{
		    $table->integer('address_id')->unsigned();

		    $table->foreign('address_id')->references('id')->on('addresses');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shipments', function($table)
		{
		    $table->dropForeign('shipments_address_id_foreign');

		    $table->dropColumn('address_id');
		});
	}

}
