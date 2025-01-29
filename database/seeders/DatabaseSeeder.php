<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use App\Models\Plant;
use App\Models\Pot;
use App\Models\Order;
use App\Models\MyCart;
use App\Models\Gardening;
use App\Models\Inquiry;
use App\Models\Review;
use App\Models\Wishlist;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //creating normal users
        $users = User::factory()->count(10)->create();

        //creating admin user
        User::factory()->admin()->create([
            'name' => 'Rijas',
            'email' => 'rijas@gmail.com',
            'password' => Hash::make('Ri123456#'),
        ]);

        //creating customers
        $users->each(function($user) {
            $customer = Customer::factory()->create([
                'user_id' => $user->id,
            ]);
        });

        //creating carts
        MyCart::factory(20)->create();

        //creating orders
        Order::factory(20)->create();

        //creating gardening orders
        Gardening::factory(20)->create();

        //creating wishlists
        Wishlist::factory(20)->create();

        //Creating Inquiries
        Inquiry::factory(20)->create();

        //creating plants
        Plant::factory(5)->create();

        //creating pots
        Pot::factory(5)->create();

        //creating reviews
        Review::factory(20)->create();

    }
}
