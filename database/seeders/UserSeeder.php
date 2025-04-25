<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'doctor', 'nurse', 'user'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'id' => (string) Str::uuid(),
                'name' => 'User ' . $i,
                'phone' => '08' . rand(1000000000, 9999999999),
                'email' => 'user' . $i . '@gmail.com',
                'email_verified_at' => now(),
                'role' => $roles[array_rand($roles)],
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
