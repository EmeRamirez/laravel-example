<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Historia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *     name="Historia",
 *     description="Operaciones sobre historias"
 * )
 *
 * @OA\PathItem(path="/api/historia")
 */
class HistoriaController extends Controller
{
    public function index()
    {
        $historias = Historia::with('imagenes')->get();

        if ($historias->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron registros',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'historia' => $historias,
            'status' => 200
        ], 200);
    }

     /**
     * @OA\Post(
     *     path="/historia",
     *     summary="Crear historia",
     *     tags={"Historia"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tipo","texto","activo"},
     *             @OA\Property(property="tipo", type="string"),
     *             @OA\Property(property="texto", type="string"),
     *             @OA\Property(property="activo", type="boolean"),
     *             @OA\Property(property="imagenes", type="array", @OA\Items(type="integer"))
     *         )
     *     ),
     *     @OA\Response(response=201, description="Creado correctamente"),
     *     @OA\Response(response=400, description="Error de validación")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required|max:255',
            'texto' => 'required',
            'activo' => 'required|boolean',
            'imagenes' => 'array',
            'imagenes.*' => 'integer|exists:imagen,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $historia = Historia::create($request->only(['tipo', 'texto', 'activo']));

        if ($request->has('imagenes')) {
            $historia->imagenes()->sync($request->imagenes);
        }

        return response()->json([
            'historia' => $historia->load('imagenes'),
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $historia = Historia::with('imagenes')->find($id);

        if (!$historia) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'historia' => $historia,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $historia = Historia::find($id);

        if (!$historia) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'tipo' => 'required|max:255',
            'texto' => 'required',
            'activo' => 'required|boolean',
            'imagenes' => 'array',
            'imagenes.*' => 'integer|exists:imagen,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $historia->update($request->only(['tipo', 'texto', 'activo']));

        if ($request->has('imagenes')) {
            $historia->imagenes()->sync($request->imagenes);
        }

        return response()->json([
            'historia' => $historia->load('imagenes'),
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $historia = Historia::find($id);

        if (!$historia) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        $historia->imagenes()->detach();
        $historia->delete();

        return response()->json([
            'message' => 'Registro eliminado',
            'status' => 200
        ], 200);
    }
}
