<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Hash;
use Illuminate\Http\Request;
use Validator;

class UsuarioController extends Controller
{

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    $usuario = Usuario::where('email', $credentials['email'])->first();

    try {
        if (!$usuario) {
            \Log::warning('Usuario no encontrado', ['email' => $credentials['email']]);
            return response()->json(['error' => 'Error de credenciales'], 401);
        }

        $loginSuccess = Hash::check($credentials['password'], $usuario->password);
        if ($loginSuccess) {
            $token = $usuario->createToken("tokenAcceso")->plainTextToken; 
            return response()->json(['token' => $token, 'user' => $usuario]);
        } else {
            \Log::warning('Contraseña incorrecta', ['email' => $credentials['email']]);
        }
    } catch (\Exception $e) {
        \Log::error('Error al iniciar sesión', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'Error interno del servidor'], 500);
    }

    return response()->json(['error' => 'Error de credenciales'], 401);
}

public function logout(Request $request){
    
}



    public function index()
    {
        $usuarios = Usuario::all();
        if ($usuarios->isEmpty()) {
            $data = [
                'message' => 'No se encontraron usuarios',
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

    public function store(Request $request)
    {
        try {
            // Validación de los datos
            $request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:usuarios,email',
                'password' => 'required|string|min:6', // 
            ]);

            
            // Crear la nueva nota
            $usuario = new Usuario();

            $usuario->nombre = $request->nombre;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->save();

            return response()->json(['usuario' => $usuario, 'mensaje' => 'Usuario creado exitosamente'], 201);
        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }   
    }



    public function show(string $id)
    {
        $usu = Usuario::find($id);
        if (isset($usu)) {
            return response()->json(data: [
                "data" => $usu,
                "mensaje" => "Usuario encontrado"
            ]);
        } else {
            return response()->json(data: [
                "error" => true,
                "mensaje" => "Usuario no encontrado"
            ]);
        }
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            // Validar los campos entrantes
            $request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:usuarios,email,' .$id,
                'password' => 'nullable|string|min:6', // 
            ]);

            $usuario = Usuario::findOrFail($id);


            $usuario->nombre = $request->nombre;
            $usuario->email = $request->email;


            if ($request->filled('password')) {

                $usuario->password = Hash::make($request->password);
            }

            // Guardar los cambios
            $usuario->save();

            return response()->json(['mensaje' => 'Usuario actualizado exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id)
    {
        $usu = Usuario::find($id);
        if ($usu) {
            $usu->delete();
            return response()->json([
                "data" => [],
                "mensaje" => "Usuario eliminado"
            ]);
        } else {
            return response()->json([
                "error" => true,
                "mensaje" => "Usuario no encontrado"
            ]);
        }
    }

    public function updatePartial(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encotrado',
                'status' => 404,
            ];
            return response()->json($data, 200);
        }
        ;

        $validator = Validator::make($request->all(), [
            'nombre' => 'string|max:255',
            'email' => 'string|email|max:255|unique:usuarios,email,' . $id,
            'password' => 'string|min:6',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'estatus' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre')) {
            $usuario->nombre = $request->nombre;
        }


        if ($request->has('email')) {
            $usuario->email = $request->email;
        }


        if ($request->has('password')) {
            $usuario->password = $request->password;
        }

        $usuario->save();
        $data = [
            'message' => 'Usuario actulizado',
            'usuario' => $usuario,
            'status' => '200',
        ];
        return response()->json($data, 200);
    }

}
