<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Historia;
class HistoriaFactory extends Factory
{
    protected $model = Historia::class;
    public function definition(): array
    {
        return [
            'tipo' => $this->faker->word(),
            'texto' => $this->faker->paragraph(),
            'activo' => $this->faker->boolean(),
        ];
    }
}
