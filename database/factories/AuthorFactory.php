<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Genera un nombre de persona falso
            'name' => fake()->name(),
        ];
    }
}