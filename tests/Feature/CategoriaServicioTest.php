<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\CategoriaServicio;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CategoriaServicioTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected string $ruta = '/api/categorias-servicio/';

    /**
     * GET: Verifica que la ruta devuelva 200 si hay datos.
     */
    public function test_acceso_ruta()
    {
        CategoriaServicio::factory()->create(); // Al menos un registro
        $response = $this->getJson($this->ruta);
        $response->assertStatus(200);
    }

    /**
     * GET: Devuelve 404 si el ID no existe.
     */
    public function test_categoria_servicio_not_found()
    {
        $response = $this->getJson($this->ruta . '999');
        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Registro no encontrado',
                     'status' => 404
                 ]);
    }

    /**
     * DELETE: Devuelve 404 si el ID no existe.
     */
    public function test_categoria_servicio_delete_not_found()
    {
        $response = $this->deleteJson($this->ruta . '999');
        $response->assertStatus(404);
    }

    /**
     * DELETE: Elimina un registro existente correctamente.
     */
    public function test_categoria_servicio_delete()
    {
        $categoria = CategoriaServicio::factory()->create();

        $response = $this->deleteJson($this->ruta . $categoria->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Registro eliminado',
                     'status' => 200
                 ]);

        $this->assertDatabaseMissing('categoria_servicio', [
            'id' => $categoria->id
        ]);
    }

    /**
     * POST: Crea un nuevo registro con datos válidos.
     */
    public function test_categoria_servicio_store()
    {
        $data = [
            'nombre' => $this->faker->word,
            'imagen' => $this->faker->imageUrl(),
            'texto' => $this->faker->sentence,
            'activo' => true
        ];

        $response = $this->postJson($this->ruta, $data);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'categoria_servicio' => [
                         'id', 'nombre', 'imagen', 'texto',
                         'activo', 'created_at', 'updated_at'
                     ],
                     'status'
                 ]);
    }

    /**
     * POST: Falla si 'activo' no es booleano.
     */
    public function test_activo_not_boolean()
    {
        $data = [
            'nombre' => $this->faker->word,
            'imagen' => $this->faker->imageUrl(),
            'texto' => $this->faker->sentence,
            'activo' => 'texto'
        ];

        $response = $this->postJson($this->ruta, $data);

        $response->assertStatus(400)
                 ->assertJsonStructure([
                     'message',
                     'errors'
                 ]);
    }

    /**
     * POST: Falla si 'nombre' supera los 255 caracteres.
     */
    public function test_nombre_max_255()
    {
        $data = [
            'nombre' => str_repeat('a', 256),
            'imagen' => $this->faker->imageUrl(),
            'texto' => $this->faker->sentence,
            'activo' => true
        ];

        $response = $this->postJson($this->ruta, $data);

        $response->assertStatus(400)
                 ->assertJsonStructure([
                     'message',
                     'errors'
                 ]);
    }

    /**
     * PUT: Actualiza un registro existente.
     */
    public function test_categoria_servicio_update()
    {
        $categoria = CategoriaServicio::factory()->create();

        $data = [
            'nombre' => $this->faker->word,
            'imagen' => $this->faker->imageUrl(),
            'texto' => $this->faker->sentence,
            'activo' => false
        ];

        $response = $this->putJson($this->ruta . $categoria->id, $data);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'categoria_servicio' => [
                         'id', 'nombre', 'imagen', 'texto',
                         'activo', 'created_at', 'updated_at'
                     ],
                     'status'
                 ]);

        $this->assertDatabaseHas('categoria_servicio', [
            'id' => $categoria->id,
            'activo' => false
        ]);
    }
}
