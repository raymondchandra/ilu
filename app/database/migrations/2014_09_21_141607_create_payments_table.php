<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('transaction_id')->unsigned();
			$table->float('paid_amt');
			$table->string('full_name');
			$table->integer('bank_id')->unsigned();
			$table->dateTime('date');
			$table->string('source_bank');
			$table->string('bank_acc_owner');
			$table->string('bank_acc_number');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments');
	}

}
