<?php

namespace Database\Factories;

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
    #[ArrayShape(['price' => "float", 'discount' => "int", 'quantity' => "int", 'product_id' => "string"])]
    public function definition(): array
    {
        if (Product::count('id') == 0) {
            Product::factory()->create();
        }
        $aProducts = Product::all(['id']);
        $product_id = $aProducts->all()[random_int(0, $aProducts->count()-1)];
        return [
            'price' => $this->faker->randomFloat(2, 0.01, 100),
            'discount' => $this->faker->numberBetween(0, 100),
            'quantity' => $this->faker->numberBetween(1, 5),
            'product_id' => $product_id
        ];
    }
}
