<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TransactionTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Transaction::create([
				
			'invoice' => $faker->randomNumber(7),
			'account_id' => $faker->numberBetween(1,10),
			'total_price' => $faker->numberBetween(1000,100000),
			'voucher_id' => $faker->numberBetween(1,10),
			'status' => $faker->word,
			'paid' => $faker->numberBetween(0,1),
			'shipment_id' => $faker->numberBetween(1,10)
			
			]);
		}
	}

}