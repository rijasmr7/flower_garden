<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Inquiry;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inquiry>
 */
class InquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Inquiry::class;
    public function definition(): array
    {
        $customer = Customer::inRandomOrder()->first() ?? Customer::factory()->create();

        
        return [
            'customer_id' => $customer->id,
            'name' => $customer->first_name.' '.$customer->last_name,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'message' => $this->faker->paragraph,
            'replies' => null,
        ];
    }
}
