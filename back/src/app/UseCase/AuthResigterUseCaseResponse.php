<?php

namespace App\UseCase;

use App\Domain\Auth\Model\Entity\User;

class AuthResigterUseCaseResponse
{
    public function __construct(
        public readonly User $user,
        public readonly string $token,
    ) {
    }
}