<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MerchSaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $amount = ['some', 2, 3, 100];
        return [
            'name' => $this->faker->name(),
            'item_name' => $this->faker->word(),
            'amount' => $this->faker->randomElement($amount),
            'price' => $this->faker->numberBetween(10, 100),
            'created_at' =>$this->faker->dateTimeBetween("-3months")
        ];
    }
}
