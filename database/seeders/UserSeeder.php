<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'LuisGranda',
            'email' => 'luisgranda@gmail.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Administrator');
        User::create([
            'full_name' => 'MariaPerez',
            'email' => 'mariaperez@gmail.com',
            'password' => Hash::make('87654321'),
        ])->assignRole('Author');

        User::factory(10)->create();
    }
}
