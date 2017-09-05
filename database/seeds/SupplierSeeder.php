<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Supplier::create([
        	'suppliername'	=> 'Supplier1', 
        	'email' => 'supplier@gmail.com',
        	'phoneno' => '000000000',        	         	
        	]);
    }
}
