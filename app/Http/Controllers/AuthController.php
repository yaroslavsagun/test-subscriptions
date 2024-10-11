<?php

declare(strict_types=1);

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $loggedIn = Auth::attempt($request->only('email', 'password'));
        if(!$loggedIn){
            return response()->redirectToRoute('login')->withErrors('Invalid credentials');
        }

        return response()->redirectToRoute('dashboard');
    }

    public function login(): View
    {
        return view('login');
    }
}
