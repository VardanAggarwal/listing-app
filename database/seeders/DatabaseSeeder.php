<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;


use \App\Models\Category;
use \App\Models\User;
use \App\Models\Profile;
use \App\Models\Finance;
use \App\Models\Linkage;
use \App\Models\Listing;
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
         $resiliencies=[];
         $admin=User::factory()->create([
             'name'=>'Vardan Aggarwal',
             'email'=>'vardan@seedsaversclub.com'
         ]);
         $resiliencies=Resiliency::factory(10)->create();
         $profiles=[];
         for ($i=0; $i < 10; $i++) { 
           array_push($profiles,Profile::factory()->for(User::factory())->create());
           Category::factory()->hasAttached($resiliencies->random(2))->create();
         }
         for ($i=0; $i <10 ; $i++) { 
            $stories=Story::factory()->for(collect($profiles)->random())->hasAttached($resiliencies->random())->create();
            $listings=Listing::factory()->for(collect($profiles)->random())->hasAttached($resiliencies->random())->create();
         }
    }
}
