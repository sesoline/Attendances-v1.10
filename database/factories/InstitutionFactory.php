<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Institution>
 */
class InstitutionFactory extends Factory
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
            'Name'     => $this->faker->company(),
            'Details'  => $this->faker->paragraph(),
            'Year'     => $this->faker->numberBetween(1960,2000),
            'Director' => $this->faker->name(),
            'Email'    => $this->faker->safeEmail(),
            'Phone'    => $this->faker->phoneNumber(),
            'Active'   => $this->faker->boolean(),
        ];
    }
}
