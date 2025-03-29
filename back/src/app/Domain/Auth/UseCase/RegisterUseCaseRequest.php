<?php

namespace App\Domain\Auth\UseCase;

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