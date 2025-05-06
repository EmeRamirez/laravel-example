<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MantenimientoInfo;
use Illuminate\Http\Request;

class MantenimientoInfoController extends Controller
{
    public function index()
    {
        return response()->json(MantenimientoInfo::where('activo', true)->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'texto' => 'required|string'
        ]);

        $item = MantenimientoInfo::create($validated);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return response()->json(MantenimientoInfo::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $item = MantenimientoInfo::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        MantenimientoInfo::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}