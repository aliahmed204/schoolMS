<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\StudentParent;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        /*User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'password' => bcrypt('12345678'),
         ]);*/
        $this->call([
            /*BloodTypeSeeder::class,
            NationalitySeeder::class,
            ReligionSeeder::class,

            GradeSedeer::class,
            ClassRoomSeeder::class,
            SectionSeeder::class,

            GendersSeeder::class,
            SpecializationSeeder::class,

            ParentSeeder::class,
            StudentSeeder::class,

            TeachersSeeder::class,*/
            SettingsTableSeeder::class

        ]);
    }
}
