<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'مدير النظام',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123456'),
                'role' => 'admin',
            ]
        );

        // Create Regular User
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'محمد علي',
                'email' => 'user@example.com',
                'password' => Hash::make('user123456'),
                'role' => 'user',
            ]
        );

        echo "\n✅ Test users created successfully!\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "ADMIN CREDENTIALS:\n";
        echo "  Email: admin@example.com\n";
        echo "  Password: admin123456\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "USER CREDENTIALS:\n";
        echo "  Email: user@example.com\n";
        echo "  Password: user123456\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    }
}
