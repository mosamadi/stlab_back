<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $array_currency = ['USD','EUR'];
        return [
            //
            'name'=> $this->faker->name(),
            'amount' => $this->faker->numberBetween(10, 100),
            'currency' => $this->faker->randomElement($array_currency),
            'donation_message' =>$this->faker->sentence(),
            'created_at' =>$this->faker->dateTimeBetween("-3months")

        ];
    }
}
