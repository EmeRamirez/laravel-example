<?php

namespace Tests\Feature;

use App\Models\Imagen;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImagenTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected string $ruta = '/api/imagenes/';

    public function test_index_devuelve_imagenes()
    {
        Imagen::factory()->count(2)->create();

        $response = $this->getJson($this->ruta);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'imagenes',
                     'status'
                 ]);
    }

    public function test_index_sin_registros()
    {
        $response = $this->getJson($this->ruta);

        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'No se encontraron registros',
                     'status' => 404
                 ]);
    }

    public function test_store_crea_imagen()
    {
        $data = [
            'nombre' => 'Test imagen',
            'imagen' => 'imagen.jpg',
            'activo' => true
        ];

        $response = $this->postJson($this->ruta, $data);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'imagen' => ['id', 'nombre', 'imagen', 'activo', 'created_at', 'updated_at'],
                     'status'
                 ]);
    }

    public function test_store_falla_validacion()
    {
        $data = [
            'nombre' => '',
            'imagen' => '',
            'activo' => 'texto'
        ];

        $response = $this->postJson($this->ruta, $data);

        $response->assertStatus(400)
                 ->assertJsonStructure([
                     'message',
                     'errors'
                 ]);
    }

    public function test_show_imagen_existente()
    {
        $imagen = Imagen::factory()->create();

        $response = $this->getJson($this->ruta . $imagen->id);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'imagen' => ['id', 'nombre', 'imagen', 'activo', 'created_at', 'updated_at'],
                     'status'
                 ]);
    }

    public function test_show_imagen_no_existente()
    {
        $response = $this->getJson($this->ruta . '999');

        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Registro no encontrado',
                     'status' => 404
                 ]);
    }

    public function test_update_imagen()
    {
        $imagen = Imagen::factory()->create();

        $data = [
            'nombre' => 'Actualizado',
            'imagen' => 'nueva.jpg',
            'activo' => false
        ];

        $response = $this->putJson($this->ruta . $imagen->id, $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 200
                 ]);
    }

    public function test_destroy_imagen()
    {
        $imagen = Imagen::factory()->create();

        $response = $this->deleteJson($this->ruta . $imagen->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Registro eliminado',
                     'status' => 200
                 ]);
    }

    public function test_destroy_imagen_no_existente()
    {
        $response = $this->deleteJson($this->ruta . '999');

        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Registro no encontrado',
                     'status' => 404
                 ]);
    }
}
