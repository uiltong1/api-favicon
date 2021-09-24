<?php 

namespace App\Application\Auth;

use App\Http\Interfaces\Auth\IAuthLogin;
use App\Http\Requests\AuthRequest;

class AuthLogin implements IAuthLogin{


    function login(AuthRequest $request)
    {
         $credentials = request(['email', 'password']);

        if(!$token = auth()->attempt($credentials)){
            return response()->json([
                'success' => false,
                'message' => 'Email ou senha incorreto.'
            ], 401);
        }
        
        return AuthGet::respondWithToken($token);
    }

    function logout()
    {
        auth()->logout();
        return response()->json([
            'success' => true,
            'message' => 'Desconectado.'
        ]);
    }

    function refresh()
    {
        return AuthGet::respondWithToken(auth()->refresh());
    }
}