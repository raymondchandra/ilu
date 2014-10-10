<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CartTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Cart::create([
				'account_id' => $faker->numberBetween(1,10),
				'price_id' => $faker->numberBetween(1,10),
				'quantity' => $faker->numberBetween(1,20)
			]);
		}
	}

}