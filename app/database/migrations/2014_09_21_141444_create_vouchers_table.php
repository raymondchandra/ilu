<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVouchersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vouchers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type');
			$table->integer('amount');
			$table->integer('account_id')->unsigned()->nullable();
			$table->date('expired_date');
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
		Schema::drop('vouchers');
	}

}
