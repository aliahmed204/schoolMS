<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>['ar' => $this->faker->name.'الاسم بالعربى' , 'en' =>  $this->faker->name],
            'email' => $this->faker->email,
            'password' => Hash::make('12345678'),
            'gender_id' => $this->faker->numberBetween(1,2),
            'nationality_id' => $this->faker->numberBetween(1,10),
            'blood_id' => $this->faker->numberBetween(1,6),
            'date_of_birth' => $this->faker->date,
            'grade_id' => $this->faker->numberBetween(1,4),
            'class_id' => $this->faker->numberBetween(1,4),
            'section_id' => $this->faker->numberBetween(1,4),
            'parent_id' => $this->faker->numberBetween(1,4),
            'academic_year' => $this->faker->date('Y'),
        ];
    }
}
