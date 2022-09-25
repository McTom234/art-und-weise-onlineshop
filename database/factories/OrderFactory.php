<?php

namespace Database\Factories;

use App\Models\Checkout;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        if (Product::count('id') == 0) {
            Product::factory()->create();
        }
        if (Checkout::count('id') == 0) {
            Checkout::factory()->create();
        }
        $aProducts = Product::all(['id']);
        $product_id = $aProducts->all()[random_int(0, $aProducts->count()-1)];
        $aCheckouts = Product::all(['id']);
        $checkout_id = $aCheckouts->all()[random_int(0, $aCheckouts->count()-1)];
        return [
            'price' => $this->faker->randomFloat(2, 0.01, 100),
            'discount' => $this->faker->numberBetween(0, 100),
            'quantity' => $this->faker->numberBetween(1, 5),
            'product_id' => $product_id,
            'checkout_id' => $checkout_id
        ];
    }
}
