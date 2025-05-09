<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoriaServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaServicioController extends Controller
{
    public function index()
    {
        $categoriaServicio = CategoriaServicio::all();

        if ($categoriaServicio->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron registros',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'categoria_servicio' => $categoriaServicio,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'imagen' => 'required',
            'texto' => 'required',
            'activo' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $categoriaServicio = CategoriaServicio::create([
            'nombre' => $request->nombre,
            'imagen' => $request->imagen,
            'texto' => $request->texto,
            'activo' => $request->activo
        ]);

        return response()->json([
            'categoria_servicio' => $categoriaServicio,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $categoriaServicio = CategoriaServicio::find($id);

        if (!$categoriaServicio) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'categoria_servicio' => $categoriaServicio,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $categoriaServicio = CategoriaServicio::find($id);

        if (!$categoriaServicio) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'imagen' => 'required',
            'texto' => 'required',
            'activo' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $categoriaServicio->update([
            'nombre' => $request->nombre,
            'imagen' => $request->imagen,
            'texto' => $request->texto,
            'activo' => $request->activo
        ]);

        return response()->json([
            'categoria_servicio' => $categoriaServicio,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $categoriaServicio = CategoriaServicio::find($id);

        if (!$categoriaServicio) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        $categoriaServicio->delete();

        return response()->json([
            'message' => 'Registro eliminado',
            'status' => 200
        ], 200);
    }
}
