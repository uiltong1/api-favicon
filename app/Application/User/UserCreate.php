<?php

namespace App\Application\User;

use App\Http\Interfaces\User\IUserCreate;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserCreate implements IUserCreate
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    function handle(UserRequest $request)
    {
        $user = $request->all();
        $user['password'] = Hash::make($user['password']);
        return $this->userRepository->save($user);
    }
}