<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InfoContacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InfoContactoController extends Controller
{
    public function index()
    {
        $infoContacto = InfoContacto::all();

        if ($infoContacto->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron registros',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'info_contacto' => $infoContacto,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'texto' => 'required',
            'texto_adicional' => 'required',
            'activo' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $infoContacto = InfoContacto::create([
            'nombre' => $request->nombre,
            'texto' => $request->texto,
            'texto_adicional' => $request->texto_adicional,
            'activo' => $request->activo
        ]);

        return response()->json([
            'info_contacto' => $infoContacto,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $infoContacto = InfoContacto::find($id);

        if (!$infoContacto) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'info_contacto' => $infoContacto,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $infoContacto = InfoContacto::find($id);

        if (!$infoContacto) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'texto' => 'required',
            'texto_adicional' => 'required',
            'activo' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $infoContacto->update([
            'nombre' => $request->nombre,
            'texto' => $request->texto,
            'texto_adicional' => $request->texto_adicional,
            'activo' => $request->activo
        ]);

        return response()->json([
            'info_contacto' => $infoContacto,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $infoContacto = InfoContacto::find($id);

        if (!$infoContacto) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        $infoContacto->delete();

        return response()->json([
            'message' => 'Registro eliminado',
            'status' => 200
        ], 200);
    }
}
