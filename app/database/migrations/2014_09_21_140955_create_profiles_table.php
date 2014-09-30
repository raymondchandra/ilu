<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('member_id');
			$table->string('full_name');
			$table->string('name_in_profile');
			$table->string('no_ktp');
			$table->string('company_name');
			$table->string('company_address');
			
			//$table->string('first-name');
			//$table->string('last-name');
			//$table->string('pob');
			$table->date('dob');
			//$table->tinyInteger('gender');
			$table->string('email');
			//$table->string('photo');
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
		Schema::drop('profiles');
	}

}
