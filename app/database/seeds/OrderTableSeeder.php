<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class OrderTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Order::create([
				'price_id' => $faker->numberBetween(1,10),
				'quantity' => $faker->numberBetween(1,20),
				'transaction_id' => $faker->numberBetween(1,10)
			]);
		}
	}

}