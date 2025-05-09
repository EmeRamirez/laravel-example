<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImagenController extends Controller
{
    public function index()
    {
        $imagenes = Imagen::all();

        if ($imagenes->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron registros',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'imagenes' => $imagenes,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'imagen' => 'required',
            'activo' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $imagen = Imagen::create([
            'nombre' => $request->nombre,
            'imagen' => $request->imagen,
            'activo' => $request->activo
        ]);

        return response()->json([
            'imagen' => $imagen,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $imagen = Imagen::find($id);

        if (!$imagen) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'imagen' => $imagen,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $imagen = Imagen::find($id);

        if (!$imagen) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'imagen' => 'required',
            'activo' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $imagen->update([
            'nombre' => $request->nombre,
            'imagen' => $request->imagen,
            'activo' => $request->activo
        ]);

        return response()->json([
            'imagen' => $imagen,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $imagen = Imagen::find($id);

        if (!$imagen) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        $imagen->delete();

        return response()->json([
            'message' => 'Registro eliminado',
            'status' => 200
        ], 200);
    }
}
