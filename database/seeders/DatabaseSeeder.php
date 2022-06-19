<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Checkout;
use App\Models\Image;
use App\Models\Location;
use App\Models\Member;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        Image::factory()->count(5)->create();
        Location::factory()->count(5)->create();
        User::factory()->count(4)->create();
        User::create(['forename' => 'Test', 'surname' => 'Admin', 'email' => 'admin@test.org', 'password' => Hash::make('password'), 'location_id' => Location::first()->id]);
        Member::factory()->count(3)->create();
        Category::factory()->count(4)->create();
        Product::factory()->count(10)->create();
        Order::factory()->count(15)->create();
        Checkout::factory()->count(5)->create();
    }
}
