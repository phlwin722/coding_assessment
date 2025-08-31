<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Admin One',
                'username' => 'admin1',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('password123')
            ],
            [
                'name' => 'Admin two',
                'username' => 'admin2',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('password123')
            ]
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }
    }
}
