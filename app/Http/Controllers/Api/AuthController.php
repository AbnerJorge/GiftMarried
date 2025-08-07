<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Registro
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo',
            'password' => 'required|min:6|confirmed',
            'es_admin' => 'boolean|nullable',
        ]);

        $user = Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'password' => bcrypt($request->password),
            'es_admin' => $request->es_admin ?? false,
        ]);

        return response()->json(['mensaje' => 'Usuario registrado correctamente']);
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required'
        ]);

        $user = Usuario::where('correo', $request->correo)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'correo' => ['Las credenciales son incorrectas'],
            ]);
        }

        $token = $user->createToken('token-personal')->plainTextToken;

        return response()->json([
            'usuario' => $user,
            'token' => $token
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['mensaje' => 'Sesión cerrada']);
    }
}
