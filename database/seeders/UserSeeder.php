<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;
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
            'name' => 'Administrator',
            'email' => 'admin@pejamas.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'Adam Albani Timmothy',
            'email' => 'adam@pejamas.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'role_id' => 3,
        ]);
        User::create([
            'name' => 'Petugas',
            'email' => 'petugas@pejamas.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now(),
            'role_id' => 2,
        ]);
    }
}
