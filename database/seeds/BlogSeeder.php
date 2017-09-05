<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
    	foreach (range(1,20) as $index) {
	        Blog::create([
	            'title' => $faker->name,
	            'body' => $faker->paragraph,
	        ]);
        }
    }
}
