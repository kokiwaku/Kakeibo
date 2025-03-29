<?php

namespace App\Domain\Auth\UseCase;

use App\Domain\Auth\Model\Value\Password;

class LoginUseCaseRequest
{
    public function __construct(
        public readonly string $email,
        public readonly Password $password,
    ) {
    }
}
