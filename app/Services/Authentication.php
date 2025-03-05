<?php

namespace App\Services;

use App\Models\User;

class Authentication
{
    public function authenticate(string $username, string $password): string
    {
        $credentials = ['username' => $username, 'password' => $password];

        if (! $token = auth()->attempt($credentials)) {
            throw new \Exception('Authentication failed');
        }

        return $token;
    }
}