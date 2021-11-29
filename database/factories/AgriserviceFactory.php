<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AgriserviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->word(),
            'description'=>$this->faker->paragraph(),
            'charges'=>$this->faker->randomNumber(2,false).$this->faker->randomElement(['%',' Rs.']),
            'type'=>$this->faker->randomElement(['others','input','market','knowledge','contract_farming']),
            'terms'=>$this->faker->paragraph(),
            'how_to'=>$this->faker->paragraph(),
            'serviceable_locations'=>$this->faker->sentence(),
            'target_audience'=>$this->faker->randomElement(['farmers','networks']),
            'min_audience'=>$this->faker->randomNumber(2,false)
            //
        ];
    }
}
