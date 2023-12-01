<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(20)->create();

        // Finding the admin role with the where method. 
        $role_admin = Role::where('name', 'admin')->first();
        // Finding the user  role with the where method. 
        $role_user = Role::where('name', 'user')->first();
        // Subscriber role
        $role_subscriber = Role::where('name', 'subscriber')->first();

        // Hard coding in an admin user.
        $admin = new User;
        $admin->name = "Jan Pantic";
        $admin->email = "admin@musicforum.com";
        $admin->password = "12345678";
        $admin->save();

        // Using the belongsToMany relationship we established earlier, laravel will let us attach the admin role and the admin user to the pivot table.

        $admin->roles()->attach($role_admin);

        // Here we're creating a regular user, who we will attach to the user role in the same way we attached the admin.
        $user = new User;
        $user->name = "Jimmy";
        $user->email = "user@musicforum.com";
        $user->password = "12345678";
        $user->save();

        $user->roles()->attach($role_user);

        // Creating a subscriber user.
        $subscriber = new User;
        $subscriber->name = "Subscriber";
        $subscriber->email = "subscriber@musicforum.com";
        $subscriber->password = "12345678";
        $subscriber->save();

        $subscriber->roles()->attach($role_subscriber);
    }
}
