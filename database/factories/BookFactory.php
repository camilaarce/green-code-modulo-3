<?php

namespace Database\Factories;

use App\Models\Author; // Asegúrate de importar el modelo Author
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Genera una frase falsa como título
            'title' => fake()->sentence(4),
            // Asocia este libro a un autor. Si no existe, lo crea.
            'author_id' => Author::factory(),
        ];
    }
}