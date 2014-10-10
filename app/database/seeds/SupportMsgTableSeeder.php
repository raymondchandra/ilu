<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SupportMsgTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			SupportMsg::create([
			'ticket_id'  => $faker->numberBetween(1,10),
			'account_id'  => $faker->numberBetween(1,10),
			'text' => $faker->text
			]);
		}
	}

}