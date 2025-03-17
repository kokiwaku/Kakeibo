<?php

namespace App\UseCase\Auth;

use App\Domain\Auth\Model\Value\Password;

class LoginUseCaseRequest
{
    public function __construct(
        public readonly string $email,
        public readonly Password $password,
    ) {
    }
}