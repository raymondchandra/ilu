<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AccountTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Account::create([
				'username' => $faker->userName,
				'password' => $faker->password,
				'active' => $faker->numberBetween(0,1),
				'role' => 1,
				'profile_id' => 1
			]);
		foreach(range(2, 10) as $index)
		{
			Account::create([
				'username' => $faker->userName,
				'password' => $faker->password,
				'active' => $faker->numberBetween(0,1),
				'role' => 0,
				'profile_id' => $index
			]);
		}
	}

}