<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class VoucherTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Voucher::create([
				
			'type' => $faker->word,
			'amount' => $faker->numberBetween(1000,100000),
			'account_id' => $faker->numberBetween(1,10),
			
			'code' => $faker->randomNumber(7)
			]);
		}
	}

}