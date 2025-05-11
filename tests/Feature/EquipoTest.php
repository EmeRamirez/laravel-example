<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Equipo;
use App\Models\Imagen;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class EquipoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected string $ruta = '/api/equipos/';

    public function test_index_devuelve_equipos()
    {
        Equipo::factory()->create();

        $response = $this->getJson($this->ruta);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'equipo',
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

    public function test_store_crea_equipo()
    {
        $data = [
            'tipo' => 'Técnico',
            'texto' => 'Texto de prueba',
            'activo' => true
        ];

        $response = $this->postJson($this->ruta, $data);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'equipo' => [
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
            'activo' => 'texto'
        ];

        $response = $this->postJson($this->ruta, $data);
        $response->assertStatus(400)
                 ->assertJsonStructure([
                     'message',
                     'errors'
                 ]);
    }

    public function test_show_equipo_existente()
    {
        $equipo = Equipo::factory()->create();

        $response = $this->getJson($this->ruta . $equipo->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'equipo' => [
                         'id', 'tipo', 'texto', 'activo', 'created_at', 'updated_at', 'imagenes'
                     ],
                     'status'
                 ]);
    }

    public function test_show_equipo_no_existente()
    {
        $response = $this->getJson($this->ruta . '999');
        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Registro no encontrado',
                     'status' => 404
                 ]);
    }

    public function test_update_equipo()
    {
        $equipo = Equipo::factory()->create();

        $data = [
            'tipo' => 'Actualizado',
            'texto' => 'Texto nuevo',
            'activo' => false
        ];

        $response = $this->putJson($this->ruta . $equipo->id, $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 200
                 ]);
    }

    public function test_destroy_equipo()
    {
        $equipo = Equipo::factory()->create();

        $response = $this->deleteJson($this->ruta . $equipo->id);
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Registro eliminado',
                     'status' => 200
                 ]);
    }

    public function test_destroy_equipo_no_existente()
    {
        $response = $this->deleteJson($this->ruta . '999');
        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Registro no encontrado',
                     'status' => 404
                 ]);
    }
}
