<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PhoneTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 5) as $index)
		{
			Phone::create([
				'profile_id' => $faker->numberBetween(1,10),
				'type' => '0',
				'number' => $faker->randomNumber(9)
				
			]);
		}

		foreach(range(6, 10) as $index)
		{
			Phone::create([
				'profile_id' => $faker->numberBetween(1,10),
				'type' => '1',
				'number' => $faker->randomNumber(9)
			]);
		}
	}

}