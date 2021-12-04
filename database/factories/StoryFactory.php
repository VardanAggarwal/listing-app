<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rating'=>$this->faker->randomElement([1,2,3,4,5]),
            'title'=>$this->faker->sentence(),
            'review'=>$this->faker->paragraph(),
            'image_url'=>$this->faker->imageUrl(),
            'links'=>$this->faker->url()

            //
        ];
    }
}
