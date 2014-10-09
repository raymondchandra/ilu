<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SupportTicketTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			SupportTicket::create([
				
			'number' => $faker->randomNumber(7),
			'account_id' => $faker->numberBetween(1,10),
			'solved' => $faker->numberBetween(0,1)
			]);
		}
	}

}