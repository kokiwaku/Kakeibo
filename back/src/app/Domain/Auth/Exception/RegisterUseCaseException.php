<?php

namespace App\Domain\Auth\Exception;

use Exception;

class RegisterUseCaseException extends Exception
{
    public const EMAIL_ALREADY_EXISTS = 'email_already_exists';
    public const AUTHENTICATION_FAILED = 'authentication_failed';
    public const REGISTRATION_FAILED = 'registration_failed';
    public const TOKEN_GENERATION_FAILED = 'token_generation_failed';
    public const CATEGORY_INITIALIZATION_FAILED = 'category_initialization_failed';
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