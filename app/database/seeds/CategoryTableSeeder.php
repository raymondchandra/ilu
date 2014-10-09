<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CategoryTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Category::create([
				'name' => $faker->name,
				'parent_category' => null,
				'deleted' => 0
			]);

		foreach(range(2, 5) as $index)
		{
			Category::create([
				'name' => $faker->name,
				'parent_category' => $index,
				'deleted' => 0
			]);
		}
	}

}