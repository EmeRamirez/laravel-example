<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\MantenimientoInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class MantenimientoInfoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected string $ruta = '/api/mantenimiento-info/';

    public function test_index_devuelve_mantenimiento_info()
    {
        MantenimientoInfo::factory()->create();

        $response = $this->getJson($this->ruta);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'mantenimiento_info',
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

    public function test_store_crea_mantenimiento_info()
    {
        $data = [
            'nombre' => 'Sistema',
            'texto' => 'Descripción del mantenimiento',
            'activo' => true
        ];

        $response = $this->postJson($this->ruta, $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'mantenimiento_info' => [
                         'id', 'nombre', 'texto', 'activo', 'created_at', 'updated_at'
                     ],
                     'status'
                 ]);
    }

    public function test_store_falla_validacion()
    {
        $data = [
            'nombre' => '',
            'texto' => '',
            'activo' => 'no-bool'
        ];

        $response = $this->postJson($this->ruta, $data);
        $response->assertStatus(400)
                 ->assertJsonStructure([
                     'message',
                     'errors'
                 ]);
    }

    public function test_show_mantenimiento_info_existente()
    {
        $info = MantenimientoInfo::factory()->create();

        $response = $this->getJson($this->ruta . $info->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'mantenimiento_info' => [
                         'id', 'nombre', 'texto', 'activo', 'created_at', 'updated_at'
                     ],
                     'status'
                 ]);
    }

    public function test_show_mantenimiento_info_no_existente()
    {
        $response = $this->getJson($this->ruta . '999');
        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Registro no encontrado',
                     'status' => 404
                 ]);
    }

    public function test_update_mantenimiento_info()
    {
        $info = MantenimientoInfo::factory()->create();

        $data = [
            'nombre' => 'Actualizado',
            'texto' => 'Texto nuevo',
            'activo' => false
        ];

        $response = $this->putJson($this->ruta . $info->id, $data);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 200
                 ]);
    }

    public function test_destroy_mantenimiento_info()
    {
        $info = MantenimientoInfo::factory()->create();

        $response = $this->deleteJson($this->ruta . $info->id);
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Registro eliminado',
                     'status' => 200
                 ]);
    }

    public function test_destroy_mantenimiento_info_no_existente()
    {
        $response = $this->deleteJson($this->ruta . '999');
        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Registro no encontrado',
                     'status' => 404
                 ]);
    }
}
