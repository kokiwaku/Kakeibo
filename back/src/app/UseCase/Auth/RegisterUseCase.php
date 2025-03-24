<?php

namespace App\UseCase\Auth;

use App\Domain\Auth\Exception\RegisterUseCaseException;
use App\UseCase\Auth\RegisterUseCaseRequest;
use App\UseCase\Auth\RegisterUseCaseResponse;
use Illuminate\Support\Facades\Auth;
use App\Domain\Auth\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

class RegisterUseCase
{

    public function __construct(
        public readonly UserRepositoryInterface $userRepository,
    )
    {
    }

    public function execute(RegisterUseCaseRequest $request): RegisterUseCaseResponse
    {
        return DB::transaction(function () use ($request): RegisterUseCaseResponse {
            // emailが登録済みか確認
            $userByRequestEmail = $this->userRepository->findBy($request->email);
            if ($userByRequestEmail !== null) {
                throw new RegisterUseCaseException(
                    errorType: RegisterUseCaseException::EMAIL_ALREADY_EXISTS,
                    message: 'This email address is already registered.',
                    code: 409,
                );
            }
            // ユーザーを登録
            $user = $this->userRepository->create($request->email, $request->name, $request->password->value);

            // ユーザーを認証済み状態にしてtokenを発行
            $credentials = [
                'email' => $user->email,
                'password' => $user->password,
            ];
            try {
                $token = Auth::attempt(credentials: $credentials);
            } catch (Throwable $e) {
                throw new RegisterUseCaseException(
                    errorType: RegisterUseCaseException::TOKEN_GENERATION_FAILED,
                    message: 'Failed to generate token.',
                );

            }

            return new RegisterUseCaseResponse(user: $user, token: $token);
        });
    }
}
