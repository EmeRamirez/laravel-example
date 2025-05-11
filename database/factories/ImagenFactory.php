<?php

namespace Database\Factories;

use App\Models\Imagen;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImagenFactory extends Factory
{
    protected $model = Imagen::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'imagen' => $this->faker->imageUrl(), // o una URL dummy como 'https://via.placeholder.com/150'
            'activo' => $this->faker->boolean()
        ];
    }
}
