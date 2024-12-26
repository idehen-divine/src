<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        User::create([
            'user_name' => 'admin',
            'uid' => '0000000001',
            'first_name' => 'john',
            'last_name' => 'doe',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'ADMIN',
            'email_verified_at' => now(),
        ]);

        User::create([
            'user_name' => 'user',
            'uid' => '0000000002',
            'first_name' => 'jane',
            'last_name' => 'doe',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'role' => 'USER',
            'email_verified_at' => now(),
        ]);
    }
}
