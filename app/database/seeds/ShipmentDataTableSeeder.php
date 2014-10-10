<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ShipmentDataTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			ShipmentData::create([
				'courier' => $faker->word,
				'destination' => $faker->city,
				'price' => $faker->numberBetween(1000,100000)
			]);
		}
	}

}