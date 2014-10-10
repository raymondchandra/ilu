<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PromotionTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Promotion::create([
				'amount' => $faker->numberBetween(1000,100000),
				'expired' => $faker->dateTime,
				'active' => $faker->numberBetween(0,1),
				 'name' => $faker->word,
				 'start_date' => $faker->dateTime
			]);
		}
	}

}