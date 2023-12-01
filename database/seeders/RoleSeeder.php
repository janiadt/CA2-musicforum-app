<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hard coding a new admin role into the seeder. 
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'An Administrator';
        $role_admin->save();

        // Doing the same with the user role.
        $role_user = new Role();
        $role_user->name = 'user';
        $role_user->description = 'The regular user';
        $role_user->save();

        // Subscriber role
        $role_subscriber = new Role();
        $role_subscriber->name = 'subscriber';
        $role_subscriber->description = 'A paying user';
        $role_subscriber->save();
    }
}
