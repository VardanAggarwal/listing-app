<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Builder;
use App\Models;
class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resiliencies=Models\Resiliency::whereRelation('categories',function(Builder $query){$query->whereIn('reliable_id',[1,22]);})->take(9)->get();
        $profiles=Models\Profile::all();
        foreach($resiliencies as $resiliency){
            $items=Models\Item::factory(5)->hasAttached($resiliency)->create();
            foreach($items as $item){
                $trades=Models\Trade::factory(10)->for($item)->for(collect($profiles)->random())->create();
            }
        }
    }
}
