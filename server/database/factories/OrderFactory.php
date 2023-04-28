<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => mt_rand(1,10),
            'payment_id' => fake()->text(10),
            'paying_amount' => mt_rand(100,2000),
            'stripe_order_id' => fake()->text(50),
            'subtotal' => mt_rand(1000,5000),
            'shipping' => mt_rand(0,1),
            'total' => mt_rand(1000,5000),
            'status' => mt_rand(0,1),
            'month' => mt_rand(1,5),
            'date' => mt_rand(1,31),
            'year' => mt_rand(2020,2030),
        ];
    }
}
