<?php

namespace App\Http\Controllers\Api;

use App\Data\LoginData;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct() {}

    public function login(Request $request)
    {
        $dataValidated = LoginData::validateAndCreate($request->only(['email', 'password']));

        $user = User::where('email', $dataValidated->email)->first();

        if (! $user || ! Hash::check($dataValidated->password, $user->password)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

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
