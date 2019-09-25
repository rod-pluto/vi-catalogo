<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface as UserInterface;

class UserRepository extends BaseRepository implements UserInterface {
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
