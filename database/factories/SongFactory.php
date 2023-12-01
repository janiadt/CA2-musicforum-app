<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // In the song factory, I will return an array which will contain all the data for a table object
            // This factory will then later be called to create the data
            'title' => $this->faker->unique()->sentence(4),
            'artist' => $this->faker->sentence(1),
            'album' => $this->faker->sentence(2),
            // In the faker documentation, I found a date, duration and url generator
            'date_published' => $this->faker->date('Y-m-d', $max = 'now'),
            'duration' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 9),
            'link' => $this->faker->unique()->url()
        ];
    }
}
