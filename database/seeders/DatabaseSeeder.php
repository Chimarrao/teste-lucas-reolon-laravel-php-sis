<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Secretaria',
            'email' => 'secretaria@example.com',
            'password' => bcrypt('password'),
            'role' => 'secretaria',
        ]);
        
        User::create([
            'name' => 'Assistente',
            'email' => 'assistente@example.com',
            'password' => bcrypt('password'),
            'role' => 'assistente',
        ]);
        
        User::create([
            'name' => 'Cadastro',
            'email' => 'cadastro@example.com',
            'password' => bcrypt('password'),
            'role' => 'cadastro',
        ]);
    }
}
