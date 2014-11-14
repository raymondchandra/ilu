<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentproff extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('PaymentProff', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('invoice');
			$table->string('nama_pembayar');
			$table->integer('id_bank')->unsigned();
			$table->string('bank_asal');
			$table->string('norek_asal');
			$table->string('nominal');
			$table->timestamps();
			
			$table->foreign('id_bank')->references('id')->on('banks');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
