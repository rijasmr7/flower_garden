<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Review;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Review::class;
    
    public function definition(): array
    {

        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'review' => $this->faker->paragraph,
            'review_for' => $this->faker->word,
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
