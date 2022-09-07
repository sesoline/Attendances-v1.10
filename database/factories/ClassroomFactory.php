<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
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
            'ClassName' => $this->faker->unique()->randomElement(['6a','6b','6c','7a','7b','7c']),
            'Details'   => $this->faker->paragraph(1),
            'Year'      => $this->faker->numberBetween(2017,2022),
            'Owner'     => $this->faker->name(),
            'OwnerEmail'=> $this->faker->email(),
            'OwnerTel'  => $this->faker->phoneNumber(),
            'Active'    => $this->faker->boolean()
        ];
    }
}
