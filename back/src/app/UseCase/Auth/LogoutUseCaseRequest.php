<?php

namespace App\UseCase\Auth;

use App\Domain\Auth\Model\Value\Password;

class LogoutUseCaseRequest
{
    public function __construct(
        public readonly string $token,
    ) {
    }
}