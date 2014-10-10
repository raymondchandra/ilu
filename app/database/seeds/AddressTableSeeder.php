<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AddressTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Address::create([
				'address' => $faker->streetAddress,
				'city' => $faker->city,
				'province' => $faker->state,
				'country' => $faker->country,
				'company' => $faker->company,
				'postal' => $faker->postcode,
				'profile_id' => $index,
				'is_main' => 1
			]);
		}

		foreach(range(1, 5) as $index)
		{
			Address::create([
				'address' => $faker->streetAddress,
				'city' => $faker->city,
				'province' => $faker->state,
				'country' => $faker->country,
				'company' => $faker->company,
				'postal' => $faker->postcode,
				'profile_id' => $index,
				'is_main' => 0
			]);
		}
	}

}