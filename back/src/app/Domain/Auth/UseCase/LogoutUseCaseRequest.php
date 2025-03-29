<?php

namespace App\Domain\Auth\UseCase;

class LogoutUseCaseRequest
{
    public function __construct(
        public readonly string $token,
    ) {
    }
}
