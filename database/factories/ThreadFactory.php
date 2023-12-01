<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $music_category = ['Pop', 'Rock', 'Jazz', 'EDM', 'Country', 'Punk Rock', 'Indie', 'Progressive Rock', 'Dance', 'Disco'];
        // Thread factory
        return [
            // We return an array of fake thread data
            // This factory will then later be called to create the data
            'title' => $this->faker->unique()->sentence(4),
            'body' => $this->faker->sentence(500),
            // Faker random elements to pick random enum value
            'music_category' => $this->faker->randomElement($music_category),
            // In the faker documentation, I found a date, duration and url generator
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            // The random user has to not be 0, because that creates an error in SQL
            'user_id' => $this->faker->randomDigitNot(0)
        ];
       
    }
}
