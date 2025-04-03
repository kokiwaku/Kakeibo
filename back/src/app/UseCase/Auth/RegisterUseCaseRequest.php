<?php

namespace App\UseCase\Auth;

use App\Domain\Auth\Model\Value\Password;

class RegisterUseCaseRequest
{
    public function __construct(
        public readonly string $email,
        public readonly string $name,
        public readonly Password $password,
    ) {
    }
}