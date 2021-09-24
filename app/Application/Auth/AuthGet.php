<?php

namespace App\Application\Auth;

use App\Http\Interfaces\Auth\IAuthGet;

class AuthGet implements IAuthGet{

    function me()
    {
        return response()->json(auth()->user());
    }

    public static function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => response()->json(auth()->user())
        ]);
    }
}