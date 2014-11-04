<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('information', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->integer('edited_by')->unsigned();
			$table->timestamps();
		});
		
		Schema::create('information_content', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_information')->unsigned();
			$table->string('sub_title');
			$table->longText('content');
			$table->integer('edited_by')->unsigned();
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
		Schema::drop('information');
	}

}
