<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemakeTemplate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('templates', function($table)
		{
		    $table->dropColumn('type');
		    $table->dropColumn('content');
		    $table->dropColumn('iscurrent');
		    $table->string('title');
		    $table->string('subject');
		    $table->longText('header');
		    $table->longText('footer');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('templates', function($table)
		{
		    $table->string('type');
		    $table->longText('content');
		    $table->tinyInteger('iscurrent');
		    $table->dropColumn('title');
		    $table->dropColumn('subject');
		    $table->dropColumn('header');
		    $table->dropColumn('footer');

		});
	}

}
