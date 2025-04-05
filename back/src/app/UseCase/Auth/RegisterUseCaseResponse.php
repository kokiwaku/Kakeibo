<?php

namespace App\UseCase\Auth;

use App\Domain\Auth\Model\Entity\User;

class RegisterUseCaseResponse
{
    public function __construct(
        public readonly User $user,
        public readonly string $token,
    ) {
    }
}