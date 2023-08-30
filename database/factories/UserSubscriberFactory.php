<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserSubscriberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $array_subscription = ['Tier1','Tier2','Tier3'];
        return [
            'name' => $this->faker->name(),
            'subscription'=>$this->faker->randomElement($array_subscription),
            'created_at' =>$this->faker->dateTimeBetween("-3months")

        ];
    }
}
