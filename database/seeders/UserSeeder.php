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
            'departments' => 'Rafael A.',
            'email' => 'raortega8906@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => 1,
        ]);
    }
}
