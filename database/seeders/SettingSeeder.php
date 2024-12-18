<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->truncate();

        DB::table('settings')->insert([
            [
                'name' => 'app_name',
                'value' => 'My app',
                'description' => 'The name of the app'
            ],
            [
                'name' => 'app_description',
                'value' => 'A description of the app',
                'description' => 'A description of the app'
            ],
            [
                'name' => 'app_email',
                'value' => 'admin@example.com',
                'description' => 'The email of the app'
            ],
            [
                'name' => 'app_phone',
                'value' => '1234567890',
                'description' => 'The phone number of the app'
            ],
            [
                'name' => 'app_address',
                'value' => '123 Main St, Anytown, USA',
                'description' => 'The address of the app'
            ],
            [
                'name' => 'app_timezone',
                'value' => 'America/New_York',
                'description' => 'The timezone of the app'
            ],
            [
                'name' => 'app_currency',
                'value' => 'NGN',
                'description' => 'The currency of the app'
            ],
            [
                'name' => 'app_currency_logo',
                'value' => '₦',
                'description' => 'The currency logo of the app'
            ],
            [
                'name' => 'app_locale',
                'value' => 'en',
                'description' => 'The locale of the app'
            ],
            [
                'name' => 'app_timezone',
                'value' => 'Africa/Lagos',
                'description' => 'The timezone of the app'
            ],
            [
                'name' => 'app_twitter',
                'value' => '',
                'description' => 'The Twitter username of the app'
            ],
            [
                'name' => 'app_instagram',
                'value' => '',
                'description' => 'The Instagram username of the app'
            ],
            [
                'name' => 'app_facebook',
                'value' => '',
                'description' => 'The Facebook username of the app'
            ],
            [
                'name' => 'app_youtube',
                'value' => '',
                'description' => 'The YouTube username of the app'
            ],
            [
                'name' => 'app_theme',
                'value' => 'light',
                'description' => 'The theme of the app'
            ],
            [
                'name' => 'app_recaptcha',
                'value' => '',
                'description' => 'The reCAPTCHA code of the app'
            ],
        ]);
    }
}
