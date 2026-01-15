<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\Referral;
use App\Models\ReferralWithdrawal;
use Illuminate\Support\Str;

class ReferralSeeder extends Seeder
{
    public function run()
    {
        // 1. Create a Referrer (The one earning money)
        $referrer = User::firstOrCreate(
            ['email' => 'referrer@example.com'],
            [
                'name' => 'John Referrer',
                'password' => bcrypt('password'),
                'role' => 'client',
                'referral_code' => 'REF123',
                'status' => 'active'
            ]
        );

        // 2. Create Referred Users (The ones placing orders)
        $referredUser1 = User::create([
            'name' => 'Alice Referred',
            'email' => 'alice' . Str::random(5) . '@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
            'referred_by' => $referrer->id,
            'status' => 'active'
        ]);

        $referredUser2 = User::create([
            'name' => 'Bob Referred',
            'email' => 'bob' . Str::random(5) . '@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
            'referred_by' => $referrer->id,
            'status' => 'active'
        ]);

        // 3. Create Orders & Generate Commissions
        
        // Ensure a subject exists
        $subject = \App\Models\Subject::firstOrCreate(
            ['name' => 'General'],
            ['description' => 'General subject']
        );

        // Order 1 from Alice
        $order1 = Order::create([
            'expiry_date' => now()->addDays(5),
            'words' => 500,
            'description' => 'Referral Test Order 1 Description',
            'subject_id' => $subject->id, 
            'total_amount' => 100.00,
            'status' => 'completed',
            'created_by' => $referredUser1->id,
            'is_visible_to_client' => true,
        ]);

        Referral::create([
            'referrer_id' => $referrer->id,
            'referred_user_id' => $referredUser1->id,
            'order_id' => $order1->id,
            'reward_amount' => 10.00, // 10% of 100
            'status' => 'pending', // Unpaid
        ]);

        // Order 2 from Bob
        $order2 = Order::create([
            'expiry_date' => now()->addDays(3),
            'words' => 300,
            'description' => 'Referral Test Order 2 Description',
            'subject_id' => $subject->id,
            'total_amount' => 60.00,
            'status' => 'completed',
            'created_by' => $referredUser2->id,
            'is_visible_to_client' => true,
        ]);

        Referral::create([
            'referrer_id' => $referrer->id,
            'referred_user_id' => $referredUser2->id,
            'order_id' => $order2->id,
            'reward_amount' => 6.00,
            'status' => 'paid', // Already paid
        ]);


        // 4. Create a Pending Withdrawal Request
        ReferralWithdrawal::create([
            'user_id' => $referrer->id,
            'amount' => 5.00,
            'status' => 'requested',
            'requested_at' => now(),
        ]);

        $this->command->info('Referral data seeded successfully!');
    }
}
