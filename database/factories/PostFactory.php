<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'dummy_post_id' => $this->faker->numberBetween(1, 5),
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ];
    }
}
