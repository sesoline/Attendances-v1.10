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
            //
            'FirstName' => $this->faker->firstName(),
            'LastName'  => $this->faker->lastName(),
            'Telephone' => $this->faker->phoneNumber(),
            'email'     => $this->faker->unique()->safeEmail(),
            'Address'   => $this->faker->address(),
            'Photo'     => $this->faker->unique()->url(),
            'ClassName' => $this->faker->randomElement(['6a','6b','6c','7a','7b','7c'])
        ];
    }
}
