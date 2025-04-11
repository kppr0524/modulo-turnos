<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;


class TurnoController extends Controller
{
    public function index()
    {
        $turnos = Turno::all();
        return view('turnos', compact('turnos'));
    }

    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required']);
        $turno = Turno::create($request->all());

        return response()->json([
            'message' => 'Turno creado correctamente.',
            'turno' => $turno
        ]);
    }

    public function update(Request $request, Turno $turno)
    {
        $request->validate(['nombre' => 'required']);
        $turno->update($request->all());

        return response()->json([
            'message' => 'Turno actualizado correctamente.',
            'turno' => $turno
        ]);
    }

    public function destroy(Turno $turno)
    {
        $turno->delete();
        return response()->json(['message' => 'Turno eliminado correctamente.']);
    }

    public function show(Turno $turno)
    {
        return response()->json($turno);
    }
}
