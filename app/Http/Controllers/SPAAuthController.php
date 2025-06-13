<?php

namespace App\Http\Controllers;

use App\Services\SPAAuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SPAAuthController extends Controller
{
    public function login(
        Request        $request,
        SPAAuthService $authService,
    )
    {
        try {
            $user = $authService->attempt($request->input());
        } catch (ValidationException|AuthenticationException) {
            return response()->json(['message' => 'Not Authenticated: Invalid Credentials.'], 401);
        }

        return response()->json($user);
    }

    public function logout(
        SPAAuthService $authService,
    )
    {
        $authService->destroy();

        return response()->json(['message' => 'Logged Out.']);
    }
}
