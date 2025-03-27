<?php

namespace App\UseCase\Auth;

class LogoutUseCaseRequest
{
    public function __construct(
        public readonly string $token,
    ) {
    }
}