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
            'total_qty'=>$this->faker->randomNumber(4,false).' kg',
            'min_qty'=>$this->faker->randomNumber(3,false).' kg',
            'price'=>'Rs. '.$this->faker->randomNumber(3,false).'/kg',
            'price_negotiable'=>$this->faker->randomElement([true,false]),
            'logistic_terms'=>$this->faker->sentence(),
            'payment_terms'=>$this->faker->sentence()
            //
        ];
    }
}
