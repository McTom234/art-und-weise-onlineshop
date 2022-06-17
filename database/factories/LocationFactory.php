<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory<Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['street' => "string", 'street_number' => "string", 'postcode' => "string", 'city' => "string"])]
    public function definition(): array
    {
        return [
            'street' => $this->faker->streetName(),
            'street_number' => $this->faker->buildingNumber(),
            'postcode' => $this->faker->postcode(),
            'city' => $this->faker->city()
        ];
    }
}
