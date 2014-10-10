<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Product::create([
				
				'product_no' => $faker->randomNumber(5),
				'name' => $faker->word,
				'description' => $faker->text,
				'category_id' => $faker->numberBetween(1,5),
				'promotion_id' => $faker->numberBetween(1,10),
				'deleted' => $faker->numberBetween(0,1)
			
			]);
		}
	}

}