<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quote>
 */
class QuoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => Book::inRandomOrder()->first()?->id ?? Book::factory(),
            'quote' => $this->faker->sentence(2),
            'page' => $this->faker->numberBetween(1, 500) ,
            'notes' => $this->faker->sentence(3),
            //
        ];
    }
}
