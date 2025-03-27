<?php

namespace App\UseCase\Auth;

use App\Domain\Auth\Exception\ValidateTokenUseCaseException;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ValidateTokenUseCase
{

    /**
     * Summary of execute
     * @return void
     */
    public function execute(): void
    {
        try {
            Auth::authenticate();
        } catch (Throwable $e) {
            throw new ValidateTokenUseCaseException(
                errorType: ValidateTokenUseCaseException::INVALID_TOKEN,
                message: 'Invalid token.',
            );
        }
    }
}
