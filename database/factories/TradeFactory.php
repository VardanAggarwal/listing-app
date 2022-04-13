<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type'=>$this->faker->randomElement(['buy','sell']),
            'media'=>$this->faker->imageUrl(),
            'price'=>$this->faker->randomNumber(3,false),
            'quantity'=>$this->faker->randomNumber(5,false),
            'description'=>$this->faker->paragraph()
        ];
    }
}
