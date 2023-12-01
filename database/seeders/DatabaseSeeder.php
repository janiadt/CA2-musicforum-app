<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Song;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Calling user seeder
        $this->call([
            UserSeeder::class
        ]);
    
        // Calling the song seeder when the database seeder is run(sail artisan db:seed)
        $this->call([
            SongSeeder::class
        ]);

         // Calling thread seeder
         $this->call([
            ThreadSeeder::class
        ]);
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Here we're seeding the pivot table between users and songs for each user. 
        foreach(User::all() as $user)
        $user = User::factory()->hasAttached(Song::factory()->count(1), 
        [
            'song_id' => random_int(1, 20),
            'user_id' => random_int(1, 20)
        ])
        ->create();
    }
}
