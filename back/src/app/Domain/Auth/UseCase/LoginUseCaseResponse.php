<?php

namespace App\Domain\Auth\UseCase;

class LoginUseCaseResponse
{
    public function __construct(
        public readonly string $token,
    ) {
    }
}