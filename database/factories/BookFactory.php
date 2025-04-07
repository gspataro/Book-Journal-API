<?php

namespace Database\Factories;

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
            'isbn' => fake()->isbn10(),
            'title' => fake()->text(),
            'authors' => fake()->name(),
            'publisher' => fake()->company(),
            'edition' => fake()->text(),
            'language' => fake()->languageCode(),
            'publication_date' => fake()->dateTime(),
            'image' => fake()->imageUrl(),
            'pages' => fake()->randomNumber(4),
            'description' => fake()->text()
        ];
    }
}
