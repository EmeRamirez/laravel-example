<?php

namespace Database\Factories;

use App\Models\MantenimientoInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class MantenimientoInfoFactory extends Factory
{
    protected $model = MantenimientoInfo::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'texto' => $this->faker->sentence(),
            'activo' => $this->faker->boolean()
        ];
    }
}
