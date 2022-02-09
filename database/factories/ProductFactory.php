<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product_name = $this->faker->text(20);
    
        return [
            'name' => $product_name,
            'slug' => Str::slug($product_name),
            'description' => $this->faker->paragraph(1),
            'price' => $this->faker->numberBetween(100,30000),
        ];
    }
}
