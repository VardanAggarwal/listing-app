<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type'=>$this->faker->randomElement(['expense','earning']),
            'item_type'=>$this->faker->randomElement(['input','labour','setup','seed','produce']),
            'item'=>$this->faker->word(),
            'amount'=>'Rs. '.$this->faker->randomNumber(3,false),
            'frequency'=> $this->faker->randomNumber(2,false).' months'
            //
        ];
    }
}
