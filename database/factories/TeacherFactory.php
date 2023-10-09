<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>[
                'ar' => $this->faker->name.'الاسم بالعربى',
                'en' =>  $this->faker->name
            ],
            'email' =>  $this->faker->email,
            'password' =>  Hash::make('12345678'),
            'joining_date' => $this->faker->date,
            'address' => $this->faker->address,
            'specialization_id' => $this->faker->numberBetween(1,9),
            'gender_id' => $this->faker->numberBetween(1,2),
        ];
    }
}
