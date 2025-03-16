<?php

namespace App\Infrastructure\Auth;

use App\Domain\Auth\Model\Entity\User;
use App\Domain\Auth\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function create(string $email, string $name, string $password): User
    {
        return User::create([
            'email' => $email,
            'name' => $name,
            'password' => $password,
        ]);
    }
}
