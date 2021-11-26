<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

use \App\Models\Crop;
use \App\Models\Category;
use \App\Models\User;
use \App\Models\Profile;
use \App\Models\Role;
use \App\Models\Agrimodel;
use \App\Models\Agriservice;
use \App\Models\Listing;
use \App\Models\Practice;
use \App\Models\Resiliency;
use \App\Models\Story;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {  
         $resiliencies=Resiliency::factory(3)->for(
            Crop::factory(),'resilient'
         )->create();
         $resiliencies=$resiliencies->union(Resiliency::factory(3)->for(
            Practice::factory(),'resilient'
         )->create());
         $resiliencies=$resiliencies->union(Resiliency::factory(3)->for(
            Agrimodel::factory(),'resilient'
         )->create());
         $categories=Category::factory(10)->hasAttached($resiliencies->random(2))->create();
         $agriservices=Agriservice::factory(5)->hasAttached($resiliencies->random(2))->create();
         $listings=Listing::factory(5)->hasAttached($resiliencies->random(2))->create();
         $stories=Story::factory(5)->hasAttached($resiliencies->random(2))->create();
         $roles=Role::factory(4)->state(new Sequence(
            ['name'=>'farmer'],
            ['name'=>'farmer_network'],
            ['name'=>'enabler'],
            ['name'=>'buyer'],
         ))->create();
         $users=User::factory(10)->has(Profile::factory(1)->hasAttached($roles->random())->hasAttached($resiliencies->random(2)))->create();
         $admin=User::factory()->has(Profile::factory(5)->hasAttached($roles->random()))->create([
             'name'=>'Vardan Aggarwal',
             'email'=>'vardan@seedsaversclub.com'
         ]);

    }
}
