<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TaxTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		
		Tax::create([
			'name' => $faker->word,
			'amount' => $faker->numberBetween(1000,100000), 
			'deleted' => $faker->numberBetween(0,1)
		]);
	}

}