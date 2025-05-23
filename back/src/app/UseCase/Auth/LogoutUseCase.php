<?php

namespace App\UseCase\Auth;

use App\Domain\Auth\Exception\LogoutUseCaseException;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class LogoutUseCase
{

    public function execute(LogoutUseCaseRequest $request)
    {
        try {
            Auth::setToken($request->token);
            Auth::invalidate();
        } catch(Throwable $e) {
            // 無効なトークンの場合
            if ($e instanceof TokenInvalidException) {
                throw new LogoutUseCaseException(
                    errorType: LogoutUseCaseException::LOGOUT_FAILED,
                    message: 'Invalid token.',
                    code: 401
                );
            }

            // その他のエラーの場合
            throw new LogoutUseCaseException(
                errorType: LogoutUseCaseException::LOGOUT_FAILED,
                message: 'An unexpected error occurred.',
                code: 500,
            );
        }
    }
}
