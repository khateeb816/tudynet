<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
                'referral_code' => strtoupper(Str::random(8)),
                'status' => 'active',
            ]
        );

        $this->command->info('Super Admin created:');
        $this->command->info('Email: admin@example.com');
        $this->command->info('Password: password');
    }
}
