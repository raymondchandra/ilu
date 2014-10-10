<?php

class DatabaseSeeder extends Seeder {

    public function run()
    {
    	DB::statement("SET foreign_key_checks = 0");
    	DB::table('accounts')->truncate();
    	DB::table('orders')->truncate();
    	DB::table('addresses')->truncate();
    	DB::table('attributes')->truncate();
    	DB::table('banks')->truncate();
    	DB::table('categories')->truncate();
    	DB::table('contacts')->truncate();
    	DB::table('galleries')->truncate();
    	DB::table('information')->truncate();
    	DB::table('logs')->truncate();
    	DB::table('menus')->truncate();
    	DB::table('messages')->truncate();
    	DB::table('news')->truncate();
    	DB::table('orders')->truncate();
    	DB::table('payments')->truncate();
    	DB::table('phones')->truncate();
    	DB::table('prices')->truncate();
    	DB::table('products')->truncate();
    	DB::table('profiles')->truncate();
    	DB::table('promotions')->truncate();
    	DB::table('reviews')->truncate();
    	DB::table('seos')->truncate();
    	DB::table('shipmentdatas')->truncate();
    	DB::table('shipments')->truncate();
    	DB::table('supportmsgs')->truncate();
    	DB::table('supporttickets')->truncate();
    	DB::table('taxes')->truncate();
    	DB::table('templates')->truncate();
    	DB::table('transactions')->truncate();
    	DB::table('vouchers')->truncate();
    	DB::table('wishlists')->truncate();

    	DB::statement("SET foreign_key_checks = 1");
		$this->call('ProfileTableSeeder');
		$this->call('AccountTableSeeder');
		$this->call('AddressTableSeeder');
		$this->call('AttributeTableSeeder');
		$this->call('BankTableSeeder');
		$this->call('CategoryTableSeeder');
		$this->call('PromotionTableSeeder');
		$this->call('ProductTableSeeder');
		$this->call('TaxTableSeeder');
		$this->call('PriceTableSeeder');
		$this->call('CartTableSeeder');
		$this->call('ContactTableSeeder');
		$this->call('InformationTableSeeder');
		$this->call('NewsTableSeeder');
		$this->call('VoucherTableSeeder');
		$this->call('ShipmentDataTableSeeder');
		$this->call('ShipmentTableSeeder');
		$this->call('TransactionTableSeeder');
		$this->call('OrderTableSeeder');
		$this->call('PaymentTableSeeder');
		$this->call('PhoneTableSeeder');
		
		$this->call('ReviewTableSeeder');
		$this->call('SupportTicketTableSeeder');
		$this->call('SupportMsgTableSeeder');
		$this->call('WishlistTableSeeder');
		
        $this->command->info('finish seeding!');
    }

}