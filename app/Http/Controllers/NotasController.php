<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Dotenv\Validator;
use Illuminate\Http\Request;

class NotasController extends Controller
{
    
    public function index()
    {
        $usuarios = Nota::all();
        if ($usuarios->isEmpty()) {
            $data = [
                'message' => 'No se encontraron notas',
                'status' => 404,
            ];
            return response()->json([$data, 200]);
        }
        return response()->json([$usuarios, 200]);
    }

    
    public function create()
    {
        //
    }

    public function updatePartial(Request $request,$id){
        $nota = Nota::find($id);
        if(!$nota) { 
            $data = [
                'message' => 'Nota no encotrada',
                'status'=> 404,
            ];
            return response()->json($data,200);
        };
        
    

        if($request->has('titulo')){
            $nota->titulo = $request->titulo;
        }

        
        if($request->has('descripcion')){
            $nota->descripcion = $request->descripcion;
        }

        
        if($request->has('fecha_vencimiento')){
            $nota->fecha_vencimiento = $request->fecha_vencimiento;
        }

        if($request->has('imagen')){
            $nota->imagen = $request->imagen;
        }

        if($request->has('etiqueta_id')){
            $nota->etiqueta_id = $request->etiqueta_id;
        }
        $nota->save();
        $data = [
            'message'=> 'Nota actulizado',
            'nota'=> $nota,
            'status'=> '200',
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        try {
            // Validación de los datos
            $validatedData = $request->validate([
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'fecha_vencimiento' => 'nullable|date', // La fecha de vencimiento es opcional
                'imagen' => 'nullable|image|max:2048', // La imagen es opcional
                'usuario_id' => 'required|exists:usuarios,id', // Verificar que el usuario existe
                'etiqueta_id' => 'required|exists:etiquetas,id', // Verificar que la etiqueta existe
            ]);

            // Inicializar imagenPath como null
            $imagenPath = null;
            if ($request->hasFile('imagen')) {
                // Guardar la imagen y obtener la ruta solo si se envía una imagen
                $imagenPath = $request->file('imagen')->store('imagenes', 'public');
            }

            // Crear la nueva nota
            $nota = Nota::create([
                'titulo' => $validatedData['titulo'],
                'descripcion' => $validatedData['descripcion'],
                'fecha_vencimiento' => $validatedData['fecha_vencimiento'] ?? null, // Asigna null si no está presente 
                'imagen' => $imagenPath, // Puede ser nulo si no hay imagen
                'usuario_id' => $validatedData['usuario_id'],
                'etiqueta_id' => $validatedData['etiqueta_id'],
            ]);

            // Responder con los detalles de la nota creada
            return response()->json(['nota' => $nota, 'mensaje' => 'Nota creada exitosamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        $nota = Nota::find($id);
        if (isset($nota)){
            return response()->json(data: [
                "data"=> $nota,
                "mensaje"=>"Nota encontrada"	
            ]);
        } else{
            return response()->json(data: [
                "error"=> true,
                "mensaje"=>"Nota no encontrada"]);	
        }
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $nota = Nota::find($id);
        if ($nota) {
            $nota->delete();
            return response()->json([
                "data" => [],
                "mensaje" => "Nota eliminada"
            ]);
        } else {
            return response()->json([
                "error" => true,
                "mensaje" => "Nota no encontrado"
            ]);
        }
    }
    
}
