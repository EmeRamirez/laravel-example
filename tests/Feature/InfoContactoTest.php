<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\InfoContacto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class InfoContactoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected string $ruta = '/api/info-contacto/';

    public function test_index_devuelve_info_contacto()
    {
        InfoContacto::factory()->create();

        $response = $this->getJson($this->ruta);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'info_contacto',
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

    public function test_store_crea_info_contacto()
    {
        $data = [
            'nombre' => 'Contacto',
            'texto' => 'Texto principal',
            'texto_adicional' => 'Más información',
            'activo' => true
        ];

        $response = $this->postJson($this->ruta, $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'info_contacto' => [
                         'id', 'nombre', 'texto', 'texto_adicional', 'activo', 'created_at', 'updated_at'
                     ],
                     'status'
                 ]);
    }

    public function test_store_falla_validacion()
    {
        $data = [
            'nombre' => '',
            'texto' => '',
            'texto_adicional' => '',
            'activo' => 'no-booleano'
        ];

        $response = $this->postJson($this->ruta, $data);
        $response->assertStatus(400)
                 ->assertJsonStructure([
                     'message',
                     'errors'
                 ]);
    }

    public function test_show_info_contacto_existente()
    {
        $info = InfoContacto::factory()->create();

        $response = $this->getJson($this->ruta . $info->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'info_contacto' => [
                         'id', 'nombre', 'texto', 'texto_adicional', 'activo', 'created_at', 'updated_at'
                     ],
                     'status'
                 ]);
    }

    public function test_show_info_contacto_no_existente()
    {
        $response = $this->getJson($this->ruta . '999');
        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Registro no encontrado',
                     'status' => 404
                 ]);
    }

    public function test_update_info_contacto()
    {
        $info = InfoContacto::factory()->create();

        $data = [
            'nombre' => 'Actualizado',
            'texto' => 'Texto nuevo',
            'texto_adicional' => 'Adicional actualizado',
            'activo' => false
        ];

        $response = $this->putJson($this->ruta . $info->id, $data);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 200
                 ]);
    }

    public function test_destroy_info_contacto()
    {
        $info = InfoContacto::factory()->create();

        $response = $this->deleteJson($this->ruta . $info->id);
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Registro eliminado',
                     'status' => 200
                 ]);
    }

    public function test_destroy_info_contacto_no_existente()
    {
        $response = $this->deleteJson($this->ruta . '999');
        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Registro no encontrado',
                     'status' => 404
                 ]);
    }
}
