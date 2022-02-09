<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $sub_total = $this->faker->numberBetween(450,40000);
        $total = $sub_total + 100;
        $total = floatval($total);
        $sub_total = floatval($sub_total);

        return [
            'sub_total' => $sub_total,
            'total' => $total,
            'is_paid' => mt_rand(0,1),
        ];
    }
}
