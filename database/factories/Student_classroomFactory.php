<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Classroom;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student_Classroom>
 */
class Student_classroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'student_id'   => $this->faker->randomElement(Student::all())['id'],
            'classroom_id' => $this->faker->randomElement(Classroom::all())['id'],
        ];
    }
}
