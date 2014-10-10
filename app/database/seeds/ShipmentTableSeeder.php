<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ShipmentTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Shipment::create([
				
				'shipmentData_id' => $faker->numberBetween(1,10),
				'number' => $faker->randomNumber(7)
			]);
		}
	}

}