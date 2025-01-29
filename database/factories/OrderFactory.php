<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Plant;
use App\Models\Pot;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Order::class;

    public function definition(): array
    {

        $orderable = $this->faker->randomElement([Plant::class, Pot::class]);
        $orderableInstance = $orderable::factory()->create();

        return [
            'customer_id' => Customer::inRandomOrder()->first()->id ?? Customer::factory()->create()->id,
            'orderable_type' => $orderable,
            'orderable_id' => $orderableInstance->id,
            'ordered_date' => $this->faker->dateTime(),
            'delivery_date' => $this->faker->dateTime(),
            'unit_price' => $this->faker->randomFloat(2, 5, 100),
            'quantity' => $this->faker->numberBetween(1, 10),
            'total_amount' => $this->faker->randomFloat(2, 20, 500),
        ];
    }
}
