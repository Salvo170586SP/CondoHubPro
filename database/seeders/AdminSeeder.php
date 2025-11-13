<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'surname' => 'admin',
            'email' => 'admin@condohubpro.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ])->assignRole('admin');
    }
}
