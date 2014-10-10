<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class BankTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Bank::create([
				'name' => $faker->creditCardType,
				'acc_number' => $faker->creditCardNumber,
				'acc_owner' => $faker->name(null),
				'deleted' => $faker->numberBetween(0,1)
			]);
		}
	}

}