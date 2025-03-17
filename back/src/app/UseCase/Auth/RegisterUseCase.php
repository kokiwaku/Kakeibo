<?php

namespace App\UseCase\Auth;

use App\UseCase\Auth\RegisterUseCaseRequest;
use App\UseCase\Auth\RegisterUseCaseResponse;
use Illuminate\Support\Facades\Auth;
use App\Domain\Auth\Repository\UserRepositoryInterface;

class RegisterUseCase
{

    public function __construct(
        public readonly UserRepositoryInterface $userRepository,
    )
    {
    }

    public function execute(RegisterUseCaseRequest $request): RegisterUseCaseResponse
    {
        // ユーザーを登録
        $user = $this->userRepository->create($request->email, $request->name, $request->password->value);

        // ユーザーを認証済み状態にしてtokenを発行
        $credentials = [
            'email' => $request->email,
            'password' => $request->password->value,
        ];
        $token = Auth::attempt(credentials: $credentials);

        return new RegisterUseCaseResponse(user: $user, token: $token);
    }
}