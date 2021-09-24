<?php

namespace App\Http\Interfaces\Auth;

use App\Http\Requests\AuthRequest;

interface IAuthLogin
{
    function login(AuthRequest $request);
    function logout();
    function refresh();
}