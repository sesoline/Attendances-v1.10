<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Classroom;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
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
            'Date'         => $this->faker->dateTimeBetween('2022-02-01','2022-05-01'),
            'Student_id'   => $this->faker->randomElement(Student::all())['id'],
            'Classroom_id' => $this->faker->randomElement(Classroom::all())['id'],
            'Attended'     => $this->faker->boolean(),
            'Excused'      => $this->faker->boolean(),
        ];
    }
}
