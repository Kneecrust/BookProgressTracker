<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        if (Genre::count() === 0) {
            $this->call(GenreSeeder::class);
        }

        Book::factory(10)->create()->each(function ($book) {
            $genres = Genre::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            $book->genres()->attach($genres);
        });
    }
}
