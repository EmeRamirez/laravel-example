<?php

namespace Database\Factories;

use App\Models\InfoContacto;
use Illuminate\Database\Eloquent\Factories\Factory;

class InfoContactoFactory extends Factory
{
    protected $model = InfoContacto::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'texto' => $this->faker->sentence(),
            'texto_adicional' => $this->faker->paragraph(),
            'activo' => $this->faker->boolean()
        ];
    }
}
