<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SPAAuthService
{
    public function attempt(array $attributes): User
    {
        $validated = Validator::make($attributes, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ])->validate();

        if (!Auth::attempt($validated)) {
            throw new AuthenticationException('Invalid credentials');
        }

        request()->session()->regenerate();

        return Auth::user();
    }

    public function destroy(): void
    {
        Auth::guard('web')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();
    }
}
