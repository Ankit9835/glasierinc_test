<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => fake()->text(20),
            'product_code' => fake()->text(10),
            'product_quantity' => mt_rand(10,20),
            'product_code' => mt_rand(100,500),
            'product_details' => fake()->text(2000),
            'selling_price' => mt_rand(1000,5000),
            'discount_price' => mt_rand(100,500),
            'status' => mt_rand(0,1),
            'category_id' => mt_rand(1,5)
        ];
    }
}
