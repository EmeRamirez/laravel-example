<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MantenimientoInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MantenimientoInfoController extends Controller
{
    public function index()
    {
        $mantenimientoInfo = MantenimientoInfo::all();

        if ($mantenimientoInfo->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron registros',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'mantenimiento_info' => $mantenimientoInfo,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
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

        $mantenimientoInfo = MantenimientoInfo::create([
            'nombre' => $request->nombre,
            'texto' => $request->texto,
            'activo' => $request->activo
        ]);

        return response()->json([
            'mantenimiento_info' => $mantenimientoInfo,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $mantenimientoInfo = MantenimientoInfo::find($id);

        if (!$mantenimientoInfo) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'mantenimiento_info' => $mantenimientoInfo,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $mantenimientoInfo = MantenimientoInfo::find($id);

        if (!$mantenimientoInfo) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
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

        $mantenimientoInfo->update([
            'nombre' => $request->nombre,
            'texto' => $request->texto,
            'activo' => $request->activo
        ]);

        return response()->json([
            'mantenimiento_info' => $mantenimientoInfo,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $mantenimientoInfo = MantenimientoInfo::find($id);

        if (!$mantenimientoInfo) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        $mantenimientoInfo->delete();

        return response()->json([
            'message' => 'Registro eliminado',
            'status' => 200
        ], 200);
    }
}
