<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'price_per_word',
                'value' => '0.10',
                'type' => 'decimal',
                'description' => 'Price per word for order calculation',
            ],
            [
                'key' => 'referral_reward_amount',
                'value' => '10.00',
                'type' => 'decimal',
                'description' => 'Fixed referral reward amount',
            ],
            [
                'key' => 'referral_min_order_amount',
                'value' => '50.00',
                'type' => 'decimal',
                'description' => 'Minimum order amount for referral reward',
            ],
            [
                'key' => 'pdf_preview_pages',
                'value' => '3',
                'type' => 'integer',
                'description' => 'Number of preview pages for half file',
            ],
            [
                'key' => 'pdf_blur_enabled',
                'value' => 'true',
                'type' => 'boolean',
                'description' => 'Enable PDF blur for half file',
            ],
            [
                'key' => 'response_time_hours',
                'value' => '24',
                'type' => 'integer',
                'description' => 'Response time in hours for meeting requests',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
