<?php

namespace App\UseCase;

use App\UseCase\AuthResigterUseCaseRequest;
use Illuminate\Support\Facades\Auth;
use App\Domain\Auth\Repository\UserRepositoryInterface;

class AuthResigterUseCase
{

    public function __construct(
        public readonly UserRepositoryInterface $userRepository,
    )
    {
    }

    public function execute(AuthResigterUseCaseRequest $request): AuthResigterUseCaseResponse
    {
        // ユーザーを登録
        $user = $this->userRepository->create($request->email, $request->name, $request->password->value);

        // ユーザーを認証済み状態にしてtokenを発行
        $credentials = [
            'email' => $request->email,
            'password' => $request->password->value,
        ];
        $token = Auth::attempt(credentials: $credentials);

        return new AuthResigterUseCaseResponse(user: $user, token: $token);
    }
}