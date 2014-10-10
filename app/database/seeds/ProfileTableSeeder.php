<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProfileTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		
		foreach(range(1, 10) as $index)
		{
			Profile::create([
				'member_id' => $faker->randomNumber(9),
				'full_name' => $faker->name(null),
				'name_in_profile' => $faker->name(null),
				'no_ktp' => $faker->randomNumber(9),
				'company_name' => $faker->company,
				'company_address' => $faker->address,
				
				'dob' => $faker->date,
				'email' => $faker->email
			]);
		}
	}

}