<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function (){
            DB::table('religions')->delete();
            $types = [
                [
                    'en'=> 'Muslim',
                    'ar'=> 'مسلم'
                ],
                [
                    'en'=> 'Christian',
                    'ar'=> 'مسيحي'
                ],
                [
                    'en'=> 'Other',
                    'ar'=> 'غيرذلك'
                ],
            ];

            foreach ($types as $type){
                Religion::create(['name'=> $type]);
            }
        });
    }
}
