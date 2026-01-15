<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ExampleUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Create Manager Account
        $manager = User::firstOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Manager User',
                'email' => 'manager@example.com',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'referral_code' => strtoupper(Str::random(8)),
                'status' => 'active',
            ]
        );

        // Create Writer Account
        $writer = User::firstOrCreate(
            ['email' => 'writer@example.com'],
            [
                'name' => 'Writer User',
                'email' => 'writer@example.com',
                'password' => Hash::make('password'),
                'role' => 'writer',
                'referral_code' => strtoupper(Str::random(8)),
                'status' => 'active',
            ]
        );

        // Create Client Account
        $client = User::firstOrCreate(
            ['email' => 'client@example.com'],
            [
                'name' => 'Client User',
                'email' => 'client@example.com',
                'password' => Hash::make('password'),
                'role' => 'client',
                'referral_code' => strtoupper(Str::random(8)),
                'status' => 'active',
            ]
        );

        // Create another Writer Account (disabled by default)
        $writer2 = User::firstOrCreate(
            ['email' => 'writer2@example.com'],
            [
                'name' => 'Writer User 2',
                'email' => 'writer2@example.com',
                'password' => Hash::make('password'),
                'role' => 'writer',
                'referral_code' => strtoupper(Str::random(8)),
                'status' => 'disabled',
            ]
        );

        // Create another Client Account
        $client2 = User::firstOrCreate(
            ['email' => 'client2@example.com'],
            [
                'name' => 'Client User 2',
                'email' => 'client2@example.com',
                'password' => Hash::make('password'),
                'role' => 'client',
                'referral_code' => strtoupper(Str::random(8)),
                'status' => 'active',
            ]
        );

        $this->command->info('Example users created:');
        $this->command->info('');
        $this->command->info('Manager Account:');
        $this->command->info('  Email: manager@example.com');
        $this->command->info('  Password: password');
        $this->command->info('');
        $this->command->info('Writer Account:');
        $this->command->info('  Email: writer@example.com');
        $this->command->info('  Password: password');
        $this->command->info('');
        $this->command->info('Client Account:');
        $this->command->info('  Email: client@example.com');
        $this->command->info('  Password: password');
        $this->command->info('');
        $this->command->info('Additional accounts:');
        $this->command->info('  Writer 2 (disabled): writer2@example.com / password');
        $this->command->info('  Client 2: client2@example.com / password');
    }
}
