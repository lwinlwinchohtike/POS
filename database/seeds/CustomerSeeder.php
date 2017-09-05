<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Customer::create([
        	'name'	=> 'Walk in Customer', 
        	'email' => 'customer@gmail.com',
        	'phonenumber' => '000000000',        	         	
        	]);
    }
}
