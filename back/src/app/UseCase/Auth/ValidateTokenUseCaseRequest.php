<?php

namespace App\UseCase\Auth;

class ValidateTokenUseCaseRequest
{
    public function __construct(
        public readonly string $token
    ) {}
}
