<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Auth\IAuthGet;
use App\Http\Interfaces\Auth\IAuthLogin;
use App\Http\Requests\AuthRequest;
use Exception;

class AuthController extends Controller
{
    private $authLogin;
    private $authget;

    public function __construct(IAuthLogin $authLogin, IAuthGet $authget)
    {
        $this->authLogin = $authLogin;
        $this->authget = $authget;
    }
   
    public function login(AuthRequest $request)
    {
        try{
            return $this->authLogin->login($request);

        } catch(Exception $e){
            response()->json([
                'success' => false,
                'messages' => $e->getMessage()
            ]);
        }
    }

    public function me()
    {
        try{
            return $this->authget->me();

        } catch(Exception $e){
            response()->json([
                'success' => false,
                'messages' => $e->getMessage()
            ]);
        }
    }

    public function logout()
    {
        try{
            return $this->authLogin->logout();

        } catch(Exception $e){
            response()->json([
                'success' => false,
                'messages' => $e->getMessage()
            ]);
        }
    }

    public function refresh()
    {
        try{
            return $this->authLogin->refresh();

        } catch(Exception $e){
            response()->json([
                'success' => false,
                'messages' => $e->getMessage()
            ]);
        }
    }
}
