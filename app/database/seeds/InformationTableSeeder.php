<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class InformationTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Information::create([
				'title' => $faker->word,
				'content' => $faker->text,
				'edited_by' => 1
			]);
		}
	}

}