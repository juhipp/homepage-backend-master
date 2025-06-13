<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function create(array $attributes): User
    {
        $validated = Validator::make($attributes, [
            'email' => ['required', 'email'],
            'firstname' => ['required', 'string', 'min:2'],
            'lastname' => ['required', 'string', 'min:2'],
            'password' => ['required', 'string', 'min:8'],
        ])->validate();

        return DB::transaction(function () use ($validated) {
            return User::create([
                'email' => $validated['email'],
                'firstname' => $validated['firstname'],
                'lastname' => $validated['lastname'],
                'password' => Hash::make($validated['password']),
            ]);
        });
    }
}
