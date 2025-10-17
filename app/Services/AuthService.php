<?php

namespace App\Services;

use App\Data\LoginData;
use App\Data\ResponseData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class AuthService
{
    public function login(LoginData $data): ResponseData
    {
        try {

            $user = User::where('email', $data->email)->first();

            if (! $user || ! Hash::check($data->password, $user->password)) {
                return new ResponseData(message: 'Credenciales inválidas', code: 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;
            return new ResponseData(
                message: 'Inicio de sesión exitoso',
                data: [
                    'user' => $user,
                    'token' => $token,
                ],
                code: 200
            );
        } catch (Throwable  $e) {
            Log::error('Login error: ' . $e->getMessage());
            return new ResponseData(message: 'Error en el servidor: ' . $e->getMessage(), code: 500);
        }
    }

    public function logout(User  $user): ResponseData
    {
        try {

            $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

            return new ResponseData(
                message: 'Sesión cerrada correctamente',
                code: 200
            );
        } catch (Throwable  $e) {
            Log::error("Ha sucedido un error al cerrar la sesion" . $e->getMessage());
            return new ResponseData(message: 'Error en el servidor: ' . $e->getMessage(), code: 500);
        }
    }

    public function me(User $user): ResponseData
    {
        try {

            $newToken = $user->createToken('auth_token')->plainTextToken;

            return new ResponseData(
                message: 'Usuario autenticado',
                data: [
                    'user' => $user,
                    'token' => $newToken,
                ],
                code: 200
            );
        } catch (Throwable  $e) {
            Log::error("Ha sucedido un error al obtener el usuario autenticado" . $e->getMessage());
            return new ResponseData(message: 'Error en el servidor: ' . $e->getMessage(), code: 500);
        }
    }
}
