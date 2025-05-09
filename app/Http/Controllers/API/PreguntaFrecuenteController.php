<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PreguntaFrecuente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PreguntaFrecuenteController extends Controller
{
    public function index()
    {
        $preguntas = PreguntaFrecuente::all();

        if ($preguntas->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron preguntas frecuentes',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'preguntas_frecuentes' => $preguntas,
            'status' => 200
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pregunta' => 'required|string',
            'respuesta' => 'required|string',
            'activo' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $pregunta = PreguntaFrecuente::create($request->all());

        return response()->json([
            'pregunta_frecuente' => $pregunta,
            'status' => 201
        ]);
    }

    public function show($id)
    {
        $pregunta = PreguntaFrecuente::find($id);

        if (!$pregunta) {
            return response()->json([
                'message' => 'Pregunta no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'pregunta_frecuente' => $pregunta,
            'status' => 200
        ]);
    }

    public function update(Request $request, $id)
    {
        $pregunta = PreguntaFrecuente::find($id);

        if (!$pregunta) {
            return response()->json([
                'message' => 'Pregunta no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'pregunta' => 'required|string',
            'respuesta' => 'required|string',
            'activo' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $pregunta->update($request->all());

        return response()->json([
            'pregunta_frecuente' => $pregunta,
            'status' => 200
        ]);
    }

    public function destroy($id)
    {
        $pregunta = PreguntaFrecuente::find($id);

        if (!$pregunta) {
            return response()->json([
                'message' => 'Pregunta no encontrada',
                'status' => 404
            ], 404);
        }

        $pregunta->delete();

        return response()->json([
            'message' => 'Pregunta eliminada',
            'status' => 200
        ]);
    }
}
