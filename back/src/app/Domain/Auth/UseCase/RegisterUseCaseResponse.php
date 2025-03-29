<?php

namespace App\Domain\Auth\UseCase;

use App\Domain\Auth\Model\Entity\User;

class RegisterUseCaseResponse
{
    public function __construct(
        public readonly User $user,
        public readonly string $token,
    ) {
    }
}
