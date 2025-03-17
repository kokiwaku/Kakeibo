<?php

namespace App\UseCase\Auth;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use App\Domain\Auth\Repository\UserRepositoryInterface;

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
            throw new AuthenticationException('Login failed: Invalid email or password');
        }

        return new LoginUseCaseResponse($token);
    }
}
