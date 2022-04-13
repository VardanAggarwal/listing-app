<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
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
            'type'=>$this->faker->randomElement(['machinery','seed','produce','processed_material','training']),
            'image_url'=>$this->faker->imageUrl(),
            'description'=>$this->faker->paragraph()
        ];
    }
}
