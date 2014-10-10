<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PriceTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Price::create([
				
			'attr_id' => $faker->numberBetween(1,10),
			'attr_value' => $faker->word,
			'product_id' => $faker->numberBetween(1,10),
			'amount' => $faker->numberBetween(1,100000),
			'tax_id' => 1
			
			]);
		}
	}

}