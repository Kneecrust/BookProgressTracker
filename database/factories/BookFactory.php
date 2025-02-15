<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author_id' => Author::factory(),
            'description' => $this->faker->paragraph(),
            'progress' => $this->faker->numberBetween(0, 100),
            'date_added' => now(),
            'started_reading' => $this->faker->optional()->date(),
            'finished_reading' => $this->faker->optional()->date(),
            //
        ];
    }
}
