<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

use \App\Models\Crop;
use \App\Models\Category;
use \App\Models\User;
use \App\Models\Profile;
use \App\Models\UserType;
use \App\Models\Agrimodel;
use \App\Models\Agriservice;
use \App\Models\Finance;
use \App\Models\Linkage;
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
         $resiliencies=[];
         $admin=User::factory()->create([
             'name'=>'Vardan Aggarwal',
             'email'=>'vardan@seedsaversclub.com'
         ]);
         for ($i=0; $i < 10; $i++) { 
           array_push($resiliencies,Resiliency::factory()->for(Crop::factory(),'resilient')->create());
           array_push($resiliencies,Resiliency::factory()->for(Practice::factory(),'resilient')->create());
           array_push($resiliencies,Resiliency::factory()->for(Agrimodel::factory(),'resilient')->create());
         }
         $roles=UserType::factory(4)->state(new Sequence(
            ['name'=>'farmer'],
            ['name'=>'farmer_network'],
            ['name'=>'enabler'],
            ['name'=>'buyer'],
         ))->create();
         $profiles=[];
         $resiliencies=collect($resiliencies);
         for ($i=0; $i < 10; $i++) { 
           array_push($profiles,Profile::factory()->for(User::factory())->hasAttached($roles->random())->hasAttached($resiliencies->random(2))->create());
           Category::factory()->hasAttached($resiliencies->random(2))->create();
         }
         for ($i=0; $i <10 ; $i++) { 
            $stories=Story::factory()->for(collect($profiles)->random())->hasLinkages(3)->hasFinances(3)->hasAttached($resiliencies->random())->create();
            $agriservices=Agriservice::factory()->for(collect($profiles)->random())->hasAttached($resiliencies->random())->create();
            $listings=Listing::factory()->for(collect($profiles)->random())->hasAttached($resiliencies->random())->create();
         }
    }
}
