<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    #[ArrayShape(['forename' => "string", 'surname' => "string", 'email' => "string", 'email_verified_at' => "\Illuminate\Support\Carbon", 'password' => "string", 'remember_token' => "string", 'location_id' => "string"])]
    public function definition(): array
    {
        if (Location::count('id') == 0) {
            Location::factory()->create();
        }
        $aUsers = Location::all(['id']);
        $location_id = $aUsers->all()[random_int(0, $aUsers->count()-1)];
        return [
            'forename' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'location_id' => $location_id
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
