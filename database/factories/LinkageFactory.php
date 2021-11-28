<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LinkageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->word(),
            'type'=>$this->faker->randomElement(['input','guidance','support']),
            'contact_number'=>$this->faker->phoneNumber(),
            'location'=>$this->faker->address()
            //
        ];
    }
}
