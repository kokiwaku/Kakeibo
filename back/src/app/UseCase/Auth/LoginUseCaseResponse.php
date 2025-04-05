<?php

namespace App\UseCase\Auth;

class LoginUseCaseResponse
{
    public function __construct(
        public readonly string $token,
    ) {
    }
}