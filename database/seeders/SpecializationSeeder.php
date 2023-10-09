<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function (){
            DB::table('specializations')->delete();
            $specializations = [
                ['en'=> 'Arabic', 'ar'=> 'عربي'],
                ['en'=> 'Sciences', 'ar'=> 'علوم'],
                ['en'=> 'Physics', 'ar'=> 'فيزياء'],
                ['en'=> 'Chemistry', 'ar'=> 'كيمياء'],
                ['en'=> 'Biology', 'ar'=> 'أحياء'],
                ['en'=> 'Geography', 'ar'=> 'جغرافيا'],
                ['en'=> 'History', 'ar'=> 'تاريخ'],
                ['en'=> 'English', 'ar'=> 'انجليزي'],
                ['en'=> 'spanish', 'ar'=> 'اسبانى'],
            ];
            foreach ($specializations as $specialization){
                Specialization::create(['name'=> $specialization]);
            }
        });
    }
}
