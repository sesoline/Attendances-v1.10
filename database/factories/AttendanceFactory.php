<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'Date'      => $this->faker->dateTimeBetween('2022-02-01','2022-05-01'),
            'StudentID' => $this->faker->numberBetween(1,30),
            'ClassName' => $this->faker->randomElement(['6a','6b','6c','7a','7b','7c']),
            'Attended'  => $this->faker->boolean(),
            'Excused'   => $this->faker->boolean(),
        ];
    }
}
