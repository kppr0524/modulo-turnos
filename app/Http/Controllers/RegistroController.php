<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;

class RegistroController extends Controller
{
    public function filtrar(Request $request)
    {
        $query = Registro::with('turno');

        if ($request->has('turno_id') && $request->turno_id != '') {
            $query->where('turno_id', $request->turno_id);
        }

        return response()->json($query->orderBy('fecha', 'desc')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'maquina' => 'required|string',
            'proyecto' => 'required|string',
            'turno_id' => 'required|exists:turnos,id',
        ]);

        Registro::create($request->all());

        return response()->json(['message' => 'Registro creado con éxito']);
    }

    public function show($id)
    {
        $registro = Registro::with('turno')->findOrFail($id);
        return response()->json($registro);
    }

    public function update(Request $request, $id)
    {
        $registro = Registro::findOrFail($id);

        $request->validate([
            'fecha' => 'required|date',
            'maquina' => 'required|string',
            'proyecto' => 'required|string',
            'turno_id' => 'required|exists:turnos,id',
        ]);

        $registro->update($request->all());

        return response()->json(['message' => 'Registro actualizado con éxito']);
    }

    public function destroy($id)
    {
        $registro = Registro::findOrFail($id);
        $registro->delete();

        return response()->json(['message' => 'Registro eliminado con éxito']);
    }
}
