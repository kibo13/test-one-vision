<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        User::query()->create($request->validated());

        return response()->json(['message' => 'Пользователь успешно зарегистрирован']);
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        $token = auth()->guard('api')->attempt($credentials);

        if (! $token) {
            return response()->json(['message' => 'Неверные учетные данные'], 401);
        }

        return response()->json([
            'data' => [
                'token' => $token
            ]
        ]);
    }
}
