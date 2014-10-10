<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ReviewTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Review::create([
				'product_id' => $faker->numberBetween(1,10),
				'text' => $faker->text,
				'rating' => $faker->numberBetween(1,10),
				'approved' => $faker->numberBetween(0,1)
			]);
		}
	}

}