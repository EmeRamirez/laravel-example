<?php

namespace Database\Factories;

use App\Models\PreguntaFrecuente;
use Illuminate\Database\Eloquent\Factories\Factory;

class PreguntaFrecuenteFactory extends Factory
{
    protected $model = PreguntaFrecuente::class;

    public function definition(): array
    {
        return [
            'pregunta' => $this->faker->sentence(6, true),
            'respuesta' => $this->faker->paragraph(),
            'activo' => $this->faker->boolean(),
        ];
    }
}
