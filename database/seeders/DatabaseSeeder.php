<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'nombre',
            'last_name' => 'apellido',
            'user_name' => 'admin',
            'password' => '123123',
            'email' => Hash::make('test@example.com')
        ]);
    }
}
