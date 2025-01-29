<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MyCart;
use App\Models\Customer;
use App\Models\Plant;
use App\Models\Pot;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MyCartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = MyCart::class;

    public function definition(): array
    {

        $cartable = $this->faker->randomElement([Plant::class, Pot::class]);
        $cartableInstance = $cartable::factory()->create();

        return [
            'customer_id' => Customer::inRandomOrder()->first()->id ?? Customer::factory()->create()->id,
            'cartable_type' => $cartable,
            'cartable_id' => $cartableInstance->id,
        ];
    }
}
