<?php

namespace App\Domain\Auth\UseCase;

use App\Domain\Auth\Exception\ValidateTokenUseCaseException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ValidateTokenUseCase
{
    public function execute(ValidateTokenUseCaseRequest $request): void
    {
        try {
            Auth::setToken($request->token);
            Auth::authenticate();
        } catch (Throwable $e) {
            if ($e instanceof AuthenticationException) {
                throw new ValidateTokenUseCaseException(
                    errorType: ValidateTokenUseCaseException::INVALID_TOKEN,
                    message: 'Invalid token.',
                    code: 401
                );
            }

            throw new ValidateTokenUseCaseException(
                errorType: ValidateTokenUseCaseException::INVALID_TOKEN,
                message: 'An unexpected error occurred.',
                code: 500,
            );
        }
    }
}
