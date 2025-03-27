<?php

namespace App\Domain\Auth\Exception;

use Exception;

class ValidateTokenUseCaseException extends Exception
{
    public const INVALID_TOKEN = 'invalid_token';
    private string $errorType;

    public function __construct(string $errorType, string $message = "", int $code = 500)
    {
        $this->errorType = $errorType;
        parent::__construct($message, $code);
    }

    public function getErrorType(): string
    {
        return $this->errorType;
    }
}