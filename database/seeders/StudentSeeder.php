<?php

namespace Database\Seeders;

use App\Models\BloodType;
use App\Models\ClassRoom;
use App\Models\Grade;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->delete();
        Student::create([
            'name' =>  ['en' => 'kareem Ali Ahmed Mohamed', 'ar' => 'كريم على أحمد محمد '],
            'email' =>  'alison@gmail.com',
            'password' =>  Hash::make('12345678'),
            'date_of_birth' =>  date('2025-01-01'),
            'academic_year' =>  '2021',
            'gender_id'     =>  '1',
            'nationality_id' =>  Nationality::all()->unique()->random()->id,
            'blood_id'       =>  BloodType::all()->unique()->random()->id,
            'grade_id'       =>  Grade::all()->unique()->random()->id,
            'class_id'       =>  ClassRoom::all()->unique()->random()->id,
            'section_id'       =>  Section::all()->unique()->random()->id,
            'parent_id'       =>  StudentParent::all()->unique()->random()->id,

        ]);


    }
}
