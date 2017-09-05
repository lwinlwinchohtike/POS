<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         Role::create([
            'name' => 'Super Admin', 
            'slug' => 'super admin',
            'permissions' => [
                 'view-product'=> true, 
                 'create-product'=> true, 
                 'update-product'=> true, 
                 'delete-product'=> true,

                 'view-category'=> true, 
                 'create-category'=> true, 
                 'update-category'=> true, 
                 'delete-category'=> true,                 

                 'view-customer'=> true, 
                 'create-customer'=> true, 
                 'update-customer'=> true, 
                 'delete-customer'=> true,

                 'view-supplier'=> true, 
                 'create-supplier'=> true, 
                 'update-supplier'=> true, 
                 'delete-supplier'=> true,
                 
                 'view-role' => true,
                 'create-role' => true,                 
                 'update-role' => true,
                 'delete-role' => true,

                 'view-user' => true, 
                 'create-user' => true,                 
                 'update-user' => true,
                 'delete-user' => true,

                 'view-payment-method'=> true, 
                 'create-payment-method'=> true, 
                 'update-payment-method'=> true, 
                 'delete-payment-method'=> true,

                 'view-product-tracking'=> true, 
                 'view-purchase'=> true, 
                 'view-sales'=> true, 
                 'view-sales-report'=> true,
                 'view-purchase-report'=> true,  

            ]
        ]);
         Role::create([
            'name' => 'Admin', 
            'slug' => 'admin',
            'permissions' => [
                'view-product'=> true, 
                 'create-product'=> true, 
                 'update-product'=> true, 
                 'delete-product'=> true,

                 'view-category'=> true, 
                 'create-category'=> true, 
                 'update-category'=> true, 
                 'delete-category'=> true,                 

                 'view-customer'=> true, 
                 'create-customer'=> true, 
                 'update-customer'=> true, 
                 'delete-customer'=> true,

                 'view-supplier'=> true, 
                 'create-supplier'=> true, 
                 'update-supplier'=> true, 
                 'delete-supplier'=> true,
                
                 'view-user' => true, 
                 'create-user' => true,                 
                 'update-user' => true,
                 'delete-user' => true,

                 //'view-product-tracking'=> true, 
                 'view-purchase'=> true, 
                 'view-sales'=> true, 
                 'view-sales-report'=> true,
                 'view-purchase-report'=> true,  
            ]
        ]);
         Role::create([
            'name' => 'Sales Person', 
            'slug' => 'sales person',
            'permissions' => [
                'view-product'=> true, 
                 'create-product'=> true, 
                 'update-product'=> true, 
                 'delete-product'=> true,

                 // 'view-category'=> true, 
                 // 'create-category'=> true, 
                 // 'update-category'=> true, 
                 // 'delete-category'=> true,                 

                 'view-customer'=> true, 
                 'create-customer'=> true, 
                 'update-customer'=> true, 
                 'delete-customer'=> true,

                 // 'view-supplier'=> true, 
                 // 'create-supplier'=> true, 
                 // 'update-supplier'=> true, 
                 // 'delete-supplier'=> true,
                
                 // 'view-user' => true, 
                 // 'create-user' => true,                 
                 // 'update-user' => true,
                 // 'delete-user' => true,

                 //'view-product-tracking'=> true, 
                 'view-purchase'=> true, 
                 'view-sales'=> true, 
                 // 'view-sales-report'=> true,
                 // 'view-purchase-report'=> true,  
            ]
        ]);
    }
}
