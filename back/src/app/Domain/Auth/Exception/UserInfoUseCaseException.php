<?php

namespace App\Domain\Auth\Exception;

use Exception;

class UserInfoUseCaseException extends Exception
{
    public const USER_NOT_AUTHENTICATED = 'user_not_authenticated';
    public const INVALID_TOKEN = 'invalid_token';
    public const UNKNOWN_ERROR = 'unknown_error';

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