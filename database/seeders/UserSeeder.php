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
        $user = [
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt(12345678),
        ];

        User::create($user);
    }
}
