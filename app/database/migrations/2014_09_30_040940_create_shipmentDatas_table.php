<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShipmentDatasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shipmentDatas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('courier');
			$table->string('destination');
			$table->string('price');

			$table->timestamps();
		});

		Schema::create('shipments', function(Blueprint $table)
		{
			$table->foreign('shipmentData_id')->references('id')->on('shipmentDatas');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('shipments', function(Blueprint $table)
		{
			$table->dropForeign('shipments_shipmentData_id_foreign');
		});

		Schema::drop('shipmentDatas');
	}

}
