<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AttributeTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Attribute::create([
				'name' => $faker->word,
				'deleted' => $faker->numberBetween(0,1)
			]);
		}
	}

}