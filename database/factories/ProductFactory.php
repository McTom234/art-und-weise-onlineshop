<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['name' => "string", 'description' => "string", 'price' => "float", 'discount' => "int", 'contingent' => "int"])]
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(400),
            'price' => $this->faker->randomFloat(0, 0.01, 100),
            'discount' => $this->faker->numberBetween(0, 100),
            'contingent' => $this->faker->numberBetween(0, 50)
        ];
    }
}
