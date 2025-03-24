<?php

namespace App\Infrastructure\Auth\Repository;

use App\Domain\Auth\Model\Entity\User;
use App\Infrastructure\Auth\Eloquent\User as EloquentUser;
use App\Domain\Auth\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function create(string $email, string $name, string $password): User
    {
        $eloquentUser = EloquentUser::create([
            'email' => $email,
            'name' => $name,
            'password' => $password,
        ]);

        return new User(
            id: $eloquentUser->id,
            email: $eloquentUser->email,
            name: $eloquentUser->name,
            password: $eloquentUser->password,
        );
    }

    public function findBy(string $email): ?User
    {
        $user = EloquentUser::where('email', $email)->first();
        if ($user === null) {
            return null;
        }
        return new User(
            id: $user->id,
            email: $user->email,
            name: $user->name,
            password: $user->password,
        );
    }
}
