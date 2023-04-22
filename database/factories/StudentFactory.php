<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            // Factory all fields except photo and descriptiors ones.
            'FirstName' => $this->faker->firstName(),
            'LastName'  => $this->faker->lastName(),
            'Telephone' => $this->faker->phoneNumber(),
            'email'     => $this->faker->unique()->safeEmail(),
            'Address'   => $this->faker->address(),

            'Institution_id' => $this->faker->randomElement(['1']),
        ];
    }
}
