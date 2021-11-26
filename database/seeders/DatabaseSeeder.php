<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Crop;
use \App\Models\Category;
use \App\Models\User;
use \App\Models\Profile;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user=User::factory()->has(Profile::factory(5))->create([
            'name'=>'Vardan Aggarwal',
            'email'=>'vardan@seedsaversclub.com'
        ]);
         $categories=Category::factory(3)->create();
         $crops=Crop::factory(10)->hasAttached($categories)->create();
         $user=User::factory(10)->has(Profile::factory(1))->create();
    }
}
