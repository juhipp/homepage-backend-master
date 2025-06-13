<?php

namespace App\Http\Controllers;

use App\Services\User\APITokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class MeController extends Controller
{
    public function user(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }

    public function issueToken(
        Request         $request,
        APITokenService $tokenService,
    ): JsonResponse
    {
        try {
            $token = $tokenService->issue($request->user(), $request->input());
        } catch (ValidationException $exception) {
            return response()->json($exception->errors(), 401);
        }

        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }

    public function revokeToken(
        Request             $request,
        PersonalAccessToken $token,
        APITokenService     $tokenService,
    ): JsonResponse
    {
        $tokenService->revoke($request->user(), $token);

        return response()->json([
            'message' => 'Token revoked',
        ]);
    }
}
