<?php

namespace App\Domain\Auth\Repository;

use App\Domain\Auth\Model\Entity\User;

interface UserRepositoryInterface
{
    public function create(string $email, string $name, string $password): User;

    public function findBy(string $email): ?User;
}