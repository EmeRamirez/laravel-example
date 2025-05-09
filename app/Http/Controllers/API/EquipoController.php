<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equipo;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EquipoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/equipo",
     *     summary="Listar todos los equipos",
     *     tags={"Equipo"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de equipos",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontraron registros"
     *     )
     * )
     */
    public function index()
    {
        $equipos = Equipo::with('imagenes')->get();

        if ($equipos->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron registros',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'equipo' => $equipos,
            'status' => 200
        ], 200);
    }
    /**
     * @OA\Post(
     *     path="/api/equipo",
     *     summary="Crear nuevo equipo",
     *     tags={"Equipo"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tipo", "texto", "activo"},
     *             @OA\Property(property="tipo", type="string", example="Administrativo"),
     *             @OA\Property(property="texto", type="string", example="Este es el texto del equipo"),
     *             @OA\Property(property="activo", type="boolean", example=true),
     *             @OA\Property(property="imagenes", type="array", @OA\Items(type="integer"), example={1, 2})
     *         )
     *     ),
     *     @OA\Response(response=201, description="Equipo creado exitosamente"),
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

        $equipo = Equipo::create($request->only(['tipo', 'texto', 'activo']));

        if ($request->has('imagenes')) {
            $equipo->imagenes()->sync($request->imagenes);
        }

        return response()->json([
            'equipo' => $equipo->load('imagenes'),
            'status' => 201
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/equipo/{id}",
     *     summary="Mostrar un equipo por ID",
     *     tags={"Equipo"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Equipo encontrado"),
     *     @OA\Response(response=404, description="No encontrado")
     * )
     */
    public function show($id)
    {
        $equipo = Equipo::with('imagenes')->find($id);

        if (!$equipo) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'equipo' => $equipo,
            'status' => 200
        ], 200);
    }
     /**
     * @OA\Put(
     *     path="/api/equipo/{id}",
     *     summary="Actualizar un equipo",
     *     tags={"Equipo"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tipo", "texto", "activo"},
     *             @OA\Property(property="tipo", type="string", example="Técnico"),
     *             @OA\Property(property="texto", type="string", example="Texto actualizado"),
     *             @OA\Property(property="activo", type="boolean", example=true),
     *             @OA\Property(property="imagenes", type="array", @OA\Items(type="integer"), example={3, 4})
     *         )
     *     ),
     *     @OA\Response(response=200, description="Equipo actualizado"),
     *     @OA\Response(response=400, description="Error de validación"),
     *     @OA\Response(response=404, description="No encontrado")
     * )
     */
    public function update(Request $request, $id)
    {
        $equipo = Equipo::find($id);

        if (!$equipo) {
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

        $equipo->update($request->only(['tipo', 'texto', 'activo']));

        if ($request->has('imagenes')) {
            $equipo->imagenes()->sync($request->imagenes);
        }

        return response()->json([
            'equipo' => $equipo->load('imagenes'),
            'status' => 200
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/equipo/{id}",
     *     summary="Eliminar un equipo",
     *     tags={"Equipo"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Registro eliminado"),
     *     @OA\Response(response=404, description="No encontrado")
     * )
     */
    public function destroy($id)
    {
        $equipo = Equipo::find($id);

        if (!$equipo) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'status' => 404
            ], 404);
        }

        $equipo->imagenes()->detach();
        $equipo->delete();

        return response()->json([
            'message' => 'Registro eliminado',
            'status' => 200
        ], 200);
    }
}
