<?php

namespace App\UseCase;

use App\Domain\Auth\Model\Value\Password;

class AuthResigterUseCaseRequest
{
    public function __construct(
        public readonly string $email,
        public readonly string $name,
        public readonly Password $password,
    ) {
    }
}