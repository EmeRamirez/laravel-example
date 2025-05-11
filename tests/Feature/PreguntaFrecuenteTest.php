<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\PreguntaFrecuente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class PreguntaFrecuenteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected string $ruta = '/api/preguntas-frecuentes/';

    public function test_index_devuelve_preguntas()
    {
        PreguntaFrecuente::factory()->create();

        $response = $this->getJson($this->ruta);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'preguntas_frecuentes',
                     'status'
                 ]);
    }

    public function test_index_sin_registros()
    {
        $response = $this->getJson($this->ruta);
        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'No se encontraron preguntas frecuentes',
                     'status' => 404
                 ]);
    }

    public function test_store_crea_pregunta()
    {
        $data = [
            'pregunta' => '¿Qué es Laravel?',
            'respuesta' => 'Un framework de PHP.',
            'activo' => true
        ];

        $response = $this->postJson($this->ruta, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'pregunta_frecuente' => [
                         'id', 'pregunta', 'respuesta', 'activo', 'created_at', 'updated_at'
                     ],
                     'status'
                 ]);
    }

    public function test_store_falla_validacion()
    {
        $data = ['pregunta' => '', 'respuesta' => '', 'activo' => 'texto'];

        $response = $this->postJson($this->ruta, $data);
        $response->assertStatus(400)
                 ->assertJsonStructure([
                     'message',
                     'errors',
                     'status'
                 ]);
    }

    public function test_show_existente()
    {
        $item = PreguntaFrecuente::factory()->create();

        $response = $this->getJson($this->ruta . $item->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'pregunta_frecuente',
                     'status'
                 ]);
    }

    public function test_show_no_existente()
    {
        $response = $this->getJson($this->ruta . '999');
        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Pregunta no encontrada',
                     'status' => 404
                 ]);
    }

    public function test_update()
    {
        $item = PreguntaFrecuente::factory()->create();

        $data = [
            'pregunta' => 'Pregunta actualizada',
            'respuesta' => 'Respuesta nueva',
            'activo' => false
        ];

        $response = $this->putJson($this->ruta . $item->id, $data);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 200
                 ]);
    }

    public function test_destroy()
    {
        $item = PreguntaFrecuente::factory()->create();

        $response = $this->deleteJson($this->ruta . $item->id);
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Pregunta eliminada',
                     'status' => 200
                 ]);
    }

    public function test_destroy_no_existente()
    {
        $response = $this->deleteJson($this->ruta . '999');
        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Pregunta no encontrada',
                     'status' => 404
                 ]);
    }
}
