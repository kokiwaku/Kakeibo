<?php

namespace App\Domain\Auth\UseCase;

use App\Domain\Auth\Exception\LoginUseCaseException;
use App\Domain\Auth\UseCase\LoginUseCaseRequest;
use App\Domain\Auth\UseCase\LoginUseCaseResponse;
use Illuminate\Support\Facades\Auth;

class LoginUseCase
{

    public function execute(LoginUseCaseRequest $request): LoginUseCaseResponse
    {
        // ユーザーを認証済み状態にしてtokenを発行
        $token = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password->value,
        ]);
        if (! $token) {
            throw new LoginUseCaseException(LoginUseCaseException::LOGIN_FAILED, 'Invalid email or password.', code: 401);
        }

        return new LoginUseCaseResponse($token);
    }
}
