<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grades')->delete();
        $grades = [
          ['en' => 'Primary' , 'ar'=>'المراحلة الأبتدائية'],
          ['en' => 'middle school' , 'ar'=>'المراحلة الأعدادية'],
          ['en' => 'high school' , 'ar'=>'المراحلة الثانوية'],
        ];
        foreach ($grades as $grade){
            Grade::create([
                'name' => $grade,
                'notes' => 'Welcome to school'
            ]);
        }
    }
}
