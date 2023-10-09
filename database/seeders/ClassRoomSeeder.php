<?php

namespace Database\Seeders;


use App\Models\ClassRoom;
use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('class_rooms')->delete();
        $classes = [
            ['en' => 'First Grade' , 'ar'=>'الصف الأول'],
            ['en' => 'Second Grade' , 'ar'=>'الصف الثانى'],
            ['en' => 'Third Grade' , 'ar'=>'الصف الثالث'],
        ];
        foreach ($classes as $class){
            ClassRoom::create([
                'name' => $class,
                'grade_id' => Grade::all()->unique()->random()->id
            ]);
        }
    }
}
