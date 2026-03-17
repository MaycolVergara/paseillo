<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PersonaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'dni' => $this->faker->unique()->randomNumber(8),
            'edad' => $this->faker->numberBetween($min = 18, $max = 80)
        ];
    }
}
