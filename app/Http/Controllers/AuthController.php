<?php

declare(strict_types=1);

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::query()->where('email', $request->input('email'))->first();
        if (!$user || !password_verify($request->input('password'), $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $user->createToken('api_token')->plainTextToken]);
    }
}
