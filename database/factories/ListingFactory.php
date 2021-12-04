<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->unique()->word(),
            'type'=>$this->faker->randomElement(['buy','sell']),
            'item_type'=>$this->faker->randomElement(['input','machinery','animal','seed','produce']),
            'image_url'=>$this->faker->imageUrl(),
            'price'=>'Rs. '.$this->faker->randomNumber(3,false).'/kg',
            'description'=>$this->faker->paragraph(),
            'location'=>$this->faker->city()
            //
        ];
    }
}
