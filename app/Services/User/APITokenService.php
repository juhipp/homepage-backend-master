<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\UnauthorizedException;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;

class APITokenService
{
    public function issue(User $user, array $attributes): NewAccessToken
    {
        $validated = Validator::make($attributes, [
            'token_name' => [
                'required',
                Rule::unique('personal_access_tokens', 'name')
                    ->where('tokenable_type', User::class)
                    ->where('tokenable_id', $user->id)
            ]
        ])->validate();

        return DB::transaction(function () use ($validated, $user) {
            return $user->createToken($validated['token_name']);
        });
    }

    public function revoke(User $user, PersonalAccessToken $token): void
    {
        if (!$user->tokens()->where('id', $token->id)->exists()) {
            throw new UnauthorizedException('User does not own given token.');
        }

        DB::transaction(function () use ($token) {
            $token->delete();
        });
    }
}
