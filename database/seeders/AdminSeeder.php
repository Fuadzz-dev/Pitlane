<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'phone' => '08123456789',
            'password' => Hash::make('admin#123'),
            'role' => 'admin'
        ]);
    }
}