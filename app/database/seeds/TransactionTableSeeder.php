<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TransactionTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			$status = '';
			$rand = $faker->numberBetween(1,4);
			if(rand == 1) $status = 'pending';
			else if(rand == 2) $status = 'onProcess';
			else if(rand == 3) $status = 'onShipping';
			else if(rand == 4) $status = 'completed';
			Transaction::create([
				
			'invoice' => $faker->randomNumber(7),
			'account_id' => $faker->numberBetween(1,10),
			'total_price' => $faker->numberBetween(1000,100000),
			'voucher_id' => $faker->numberBetween(1,10),
			'status' => $status,
			'paid' => $faker->numberBetween(0,1),
			'shipment_id' => $faker->numberBetween(1,10)
			
			]);
		}
	}

}