<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Wishlist;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wishlist>
 */
class WishlistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Wishlist::class;
    public function definition(): array
    {
        $customer = Customer::inRandomOrder()->first() ?? Customer::factory()->create();

        return [
            'customer_id' => $customer->id,
            'customer_name' => $customer->first_name . ' ' . $customer->last_name,
            'phone' => $customer->phone,
            'product_name' => $this->faker->word,
            'product_specification' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),
        ];
    }
}
