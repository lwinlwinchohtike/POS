<?php

use Illuminate\Database\Seeder;
use App\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
        	'name'	=> 'Cash',         	
        	]);
    }
}
