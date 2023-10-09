<?php

namespace Database\Seeders;

use App\Models\Genders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function (){
            DB::table('genders')->delete();
            $genders = [
                ['en'=> 'Male', 'ar'=> 'ذكر'],
                ['en'=> 'Female', 'ar'=> 'أنثى'],
            ];
            foreach ($genders as $gender){
                Genders::create(['name'=> $gender]);
            }
        });
    }
}
