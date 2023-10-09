<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->delete();

        DB::table('settings')->insert([
            ['key' => 'current_session', 'value' => '2021-2022'],
            ['key' => 'school_title', 'value' => 'MS'],
            ['key' => 'school_name', 'value' => 'ALi Ahmed International Schools'],
            ['key' => 'end_first_term', 'value' => '12-01-2024'],
            ['key' => 'end_second_term', 'value' => '15-06-2024'],
            ['key' => 'phone', 'value' => '0123456789'],
            ['key' => 'address', 'value' => 'القاهرة'],
            ['key' => 'school_email', 'value' => 'ali.ah.mo.ali204@gmail.com'],
            ['key' => 'logo', 'value' => 'logo.jpg'],
        ]);
    }
}
