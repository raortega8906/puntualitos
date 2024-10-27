<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Rafael A.',
            'last_name' => 'Ortega Valderrama',
            'departments' => 'Desarrollo',
            'holidays' => 22,
            'email' => 'raortega8906@gmail.com',
            'password' => bcrypt('laravel2024.'),
            'is_admin' => 1,
            'approved' => 1,
        ]);
    }
}
