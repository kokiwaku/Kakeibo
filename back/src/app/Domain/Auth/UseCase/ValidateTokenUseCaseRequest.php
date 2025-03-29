<?php

namespace App\Domain\Auth\UseCase;

class ValidateTokenUseCaseRequest
{
    public function __construct(
        public readonly string $token
    ) {}
}
