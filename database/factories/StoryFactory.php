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
            'overall'=>$this->faker->randomElement([-1,1]),
            'advantages'=>$this->faker->sentences(5,true),
            'risks'=>$this->faker->sentences(5,true),
            'best_practices'=>$this->faker->sentences(5,true),
            'climate_conditions'=>$this->faker->sentences(5,true),
            'season'=>$this->faker->randomElement(['kharif','rabi','any']),
            'lifetime'=>$this->faker->randomNumber(1,false).' months',
            'infra'=>$this->faker->sentences(2,true),
            'services'=>$this->faker->randomElement(['inputs','guidance','market']),
            'links'=>$this->faker->url()

            //
        ];
    }
}
