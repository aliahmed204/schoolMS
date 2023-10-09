<?php

namespace Database\Seeders;

use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\StudentAccount;
use App\Models\StudentParent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('student_parents')->delete();
        StudentParent::create([
            'email' =>  'ali.ah.mo.ali204@gmail.com',
            'password' =>  Hash::make('12345678'),
            'Father_Name' =>  ['en' => 'Ali Ahmed Mohamed', 'ar' => 'على أحمد محمد '],
            'Father_National_ID' =>  '1234567810',
            'Father_Passport_ID' =>  '1234567810',
            'Father_Phone'       =>  '1234567810',
            'Father_job'       =>  ['en' => 'programmer', 'ar' => 'مبرمج'],
            'Father_Address'       =>  'القاهرة مصر',
            'Father_Nationality'       =>  Nationality::all()->unique()->random()->id,
            'Father_Blood_Type'       =>  BloodType::all()->unique()->random()->id,
            'Father_Religion'       =>  Religion::all()->unique()->random()->id,

            'Mother_Name' =>  ['en' => 'ddd dddd ddddd', 'ar' => 'دددد ددد دددد '],
            'Mother_National_ID' =>  '1234567810',
            'Mother_Passport_ID' =>  '1234567810',
            'Mother_Phone'       =>  '1234567810',
            'Mother_Job'         =>  ['en' => 'Teacher', 'ar' => 'معلمة'],
            'Mother_Address'     =>  'القاهرة مصر',
            'Mother_Nationality' =>  Nationality::all()->unique()->random()->id,
            'Mother_Blood_Type'  =>  BloodType::all()->unique()->random()->id,
            'Mother_Religion'    =>  Religion::all()->unique()->random()->id,

        ]);

    }
}
