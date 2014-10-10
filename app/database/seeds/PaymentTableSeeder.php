<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PaymentTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Payment::create([

				'full_name' => $faker->name(null),
				'transaction_id' => $faker->numberBetween(1,10),
				'paid_amt' => $faker->numberBetween(1,100000),
				'bank_id' => $faker->numberBetween(1,10),
				'date' => $faker->date('Y-m-d'),
				'source_bank' => $faker->creditCardType,
				'bank_acc_number' => $faker->creditCardNumber,
				'bank_acc_owner' => $faker->name(null)
			]);
		}
	}

}