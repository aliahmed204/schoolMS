<?php

namespace Database\Seeders;

use App\Models\BloodType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function (){
            DB::table('blood_types')->delete();
            $types = ['O-','O+','A-','A+','B-','B+','AB+','AB-'];

            foreach ($types as $type){
                BloodType::create(['name'=> $type]);
            }
        });


    }
}
