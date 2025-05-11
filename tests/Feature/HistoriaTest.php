<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Historia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class HistoriaTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected string $ruta = '/api/historias/';

    public function test_index_devuelve_historias()
    {
        Historia::factory()->create();

        $response = $this->getJson($this->ruta);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'historia',
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

    public function test_store_crea_historia()
    {
        $data = [
            'tipo' => 'Crónica',
            'texto' => 'Texto de ejemplo',
            'activo' => true
        ];

        $response = $this->postJson($this->ruta, $data);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'historia' => [
                         'id', 'tipo', 'texto', 'activo', 'created_at', 'updated_at', 'imagenes'
                     ],
                     'status'
                 ]);
    }

    public function test_store_falla_validacion()
    {
        $data = [
            'tipo' => '',
            'texto' => '',
            'activo' => 'no-boolean'
        ];

        $response = $this->postJson($this->ruta, $data);

        $response->assertStatus(400)
                 ->assertJsonStructure([
                     'message',
                     'errors'
                 ]);
    }

    public function test_show_historia_existente()
    {
        $historia = Historia::factory()->create();

        $response = $this->getJson($this->ruta . $historia->id);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'historia' => [
                         'id', 'tipo', 'texto', 'activo', 'created_at', 'updated_at', 'imagenes'
                     ],
                     'status'
                 ]);
    }

    public function test_show_historia_no_existente()
    {
        $response = $this->getJson($this->ruta . '999');

        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Registro no encontrado',
                     'status' => 404
                 ]);
    }

    public function test_update_historia()
    {
        $historia = Historia::factory()->create();

        $data = [
            'tipo' => 'Actualizado',
            'texto' => 'Nuevo texto',
            'activo' => false
        ];

        $response = $this->putJson($this->ruta . $historia->id, $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 200
                 ]);
    }

    public function test_destroy_historia()
    {
        $historia = Historia::factory()->create();

        $response = $this->deleteJson($this->ruta . $historia->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Registro eliminado',
                     'status' => 200
                 ]);
    }

    public function test_destroy_historia_no_existente()
    {
        $response = $this->deleteJson($this->ruta . '999');

        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Registro no encontrado',
                     'status' => 404
                 ]);
    }
}
