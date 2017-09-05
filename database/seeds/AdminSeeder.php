<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        //
        
        // User::create([
        // 	'name'	=> 'Super Admin',
        // 	'email'	=> 'superadmin@gmail.com',
        // 	'password'	=> bcrypt("123456"),
        // 	'is_admin'	=> true,
        // 	'is_super'	=> true,
        // 	]);

        // User::create([
        //     'name'  => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password'  => bcrypt("123456"),
        //     'is_admin'  => true,
        //     'is_super'  => false
        //     ]);

        $user = new User();
        $user->name = "Super Admin";
        $user->email = "superadmin@gmail.com";
        $user->password = bcrypt("123456");
        $user->is_admin = true;
        $user->is_super = true;
        $user->save();
        $user->roles()->attach(Role::where('name','Super Admin')->first());  

        $user = new User();
        $user->name = "Admin";
        $user->email = "admin@gmail.com";
        $user->password = bcrypt("123456");
        $user->is_admin = true;
        $user->is_super = false;
        $user->save();
        $user->roles()->attach(Role::where('name','Admin')->first());  

        $user = new User();
        $user->name = "Sales Person";
        $user->email = "salesperson@gmail.com";
        $user->password = bcrypt("123456");
        $user->is_admin = false;
        $user->is_super = false;
        $user->save();
        $user->roles()->attach(Role::where('name','Sales Person')->first());  

    }
}
