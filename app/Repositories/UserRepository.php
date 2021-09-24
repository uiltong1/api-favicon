<?php

namespace app\Repositories;

use App\Models\User;
use App\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository{
    
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

}