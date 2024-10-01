<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta; // Asegúrate de importar el modelo
use Illuminate\Http\Request;

class EtiquetasController extends Controller
{

    public function index()
    {
        $etiquetas = Etiqueta::all();
        return response()->json($etiquetas, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:etiquetas,nombre', // Valida el nombre
        ]);

        $etiqueta = Etiqueta::create([
            'nombre' => $validatedData['nombre'],
        ]);

        return response()->json(['etiqueta' => $etiqueta, 'mensaje' => 'Etiqueta creada exitosamente'], 201);
    }

    
    public function show(string $id)
    {
        $etiqueta = Etiqueta::find($id);
        if (!$etiqueta) {
            return response()->json(['mensaje' => 'Etiqueta no encontrada'], 404);
        }

        return response()->json($etiqueta, 200);
    }


    public function update(Request $request, string $id)
    {
        $etiqueta = Etiqueta::find($id);
        if (!$etiqueta) {
            return response()->json(['mensaje' => 'Etiqueta no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:etiquetas,nombre,' . $etiqueta->id,
        ]);

        $etiqueta->nombre = $validatedData['nombre'];
        $etiqueta->save();

        return response()->json(['etiqueta' => $etiqueta, 'mensaje' => 'Etiqueta actualizada exitosamente'], 200);
    }

    public function destroy(string $id)
    {
        $etiqueta = Etiqueta::find($id);
        if (!$etiqueta) {
            return response()->json(['mensaje' => 'Etiqueta no encontrada'], 404);
        }

        $etiqueta->delete();
        return response()->json(['mensaje' => 'Etiqueta eliminada exitosamente'], 200);
    }
}
