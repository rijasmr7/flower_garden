<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Gardening;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gardening>
 */
class GardeningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Gardening::class;

    public function definition(): array
    {
        $customer = Customer::inRandomOrder()->first() ?? Customer::factory()->create();


        return [
            'customer_id' => $customer->id,
            'customer_name' => $customer->first_name . ' ' . $customer->last_name,
            'phone' => $customer->phone,
            'address' => $customer->address,
            'gardening_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
