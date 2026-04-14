<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SystemSetting;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'tax_rate',
                'value' => '18',
                'type' => 'number',
                'description' => 'Tax rate percentage applied to sales',
            ],
            [
                'key' => 'tax_enabled',
                'value' => 'true',
                'type' => 'boolean',
                'description' => 'Enable tax calculation on sales',
            ],
            [
                'key' => 'company_name',
                'value' => 'Business Management System',
                'type' => 'text',
                'description' => 'Company name displayed on reports and invoices',
            ],
            [
                'key' => 'currency_code',
                'value' => 'TZS',
                'type' => 'text',
                'description' => 'Currency code for financial displays',
            ],
            [
                'key' => 'default_payment_method',
                'value' => 'cash',
                'type' => 'text',
                'description' => 'Default payment method for new sales',
            ],
        ];

        foreach ($settings as $setting) {
            SystemSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('System settings seeded successfully.');
    }
}
