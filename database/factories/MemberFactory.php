<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory<Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    #[ArrayShape(['rights' => "int", 'user_id' => "string"])]
    public function definition(): array
    {
        if (User::count('id') == 0) {
            User::factory()->create();
        }
        $aUsers = User::all(['id']);
        $user_id = $aUsers->all()[random_int(0, $aUsers->count()-1)];
        return [
            'rights' => 0,
            'user_id' => $user_id
        ];
    }
}
