<?php

namespace App\Http\Controllers\Api;

use App\Data\LoginData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct() {}

    public function login(Request $request)
    {
        $dataValidated = LoginData::validateAndCreate($request->only(['email', 'password']));

        $auth = Auth::attempt([
            'email' => $dataValidated->email,
            'password' => $dataValidated->password,
        ]);

        if (!$auth) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}
