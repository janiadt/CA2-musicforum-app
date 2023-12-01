<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// Using our model
use App\Models\Song;
use Faker\Generator as Faker;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // The seeder's run function will find the factory of the song model and create 20 instances of table data
        Song::factory()->count(20)->create();

        
    }
}
