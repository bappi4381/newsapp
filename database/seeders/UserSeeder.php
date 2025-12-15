<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // ADMIN USER
        $admin = User::firstOrCreate(
            ['email' => 'admin@newsportal.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('Admin');

        // EDITOR USER
        $editor = User::firstOrCreate(
            ['email' => 'editor@newsportal.com'],
            [
                'name' => 'Editor User',
                'password' => Hash::make('password'),
            ]
        );
        $editor->assignRole('Editor');

        // AUTHOR USER
        $author = User::firstOrCreate(
            ['email' => 'author@newsportal.com'],
            [
                'name' => 'Author User',
                'password' => Hash::make('password'),
            ]
        );
        $author->assignRole('Author');
    }
}
