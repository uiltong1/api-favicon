<?php

namespace App\Http\Interfaces\User;

use App\Http\Requests\UserRequest;

interface IUserCreate{
    function handle(UserRequest $request);
}