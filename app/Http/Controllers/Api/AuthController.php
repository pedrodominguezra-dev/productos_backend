<?php

namespace App\Http\Controllers\Api;

use App\Data\LoginData;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;


class AuthController extends Controller
{

    // Controlador para la autenticación de usuarios
    public function __construct(
        protected AuthService $authService,
    ) {}

    
    public function login(LoginRequest $request, LoginData $data)
    {
        return $this->authService->login($data);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request->user());
    }

    public function me(Request $request)
    {
        return $this->authService->me($request->user());
    }
}
