<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pot;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pot>
 */
class PotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Pot::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 5, 100),
            'size' => $this->faker->randomElement(['small', 'medium', 'large']),
            'description' => $this->faker->sentence,
            'category' => $this->faker->word,
            'is_available' => $this->faker->boolean,
            'quantity' => $this->faker->numberBetween(1, 100),
            'pot_color' => $this->faker->colorName,
            'purchased_date' => $this->faker->date(),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
