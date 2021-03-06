<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupportTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('supportTickets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('number');
			$table->string('subject');
			$table->integer('account_id')->unsigned();
			$table->tinyInteger('solved')->default(0);
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
		Schema::drop('supportTickets');
	}

}
