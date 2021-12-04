<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'address'=>$this->faker->city(),
            'pincode'=>$this->faker->postcode(),
            'contact_number'=>$this->faker->phoneNumber()
            //
        ];
    }
}
