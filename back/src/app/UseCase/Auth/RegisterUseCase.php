<?php

namespace App\UseCase\Auth;

use App\Domain\Auth\Exception\RegisterUseCaseException;
use App\UseCase\Auth\RegisterUseCaseRequest;
use App\UseCase\Auth\RegisterUseCaseResponse;
use Illuminate\Support\Facades\Auth;
use App\Domain\Auth\Repository\UserRepositoryInterface;
use App\Domain\Category\Service\CategoryInitializationService;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Log;

class RegisterUseCase
{

    public function __construct(
        public readonly UserRepositoryInterface $userRepository,
        public readonly CategoryInitializationService $categoryInitializationService
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
                'email' => $request->email,
                'password' => $request->password->value,
            ];
            try {
                $token = Auth::attempt(credentials: $credentials);
            } catch (Throwable $e) {
                Log::error('Failed to generate token.', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw new RegisterUseCaseException(
                    errorType: RegisterUseCaseException::TOKEN_GENERATION_FAILED,
                    message: 'Failed to generate token.',
                );
            }

            // デフォルトカテゴリを設定
            try {
                $this->categoryInitializationService->initializeDefaultCategories($user->id);
            } catch (Throwable $e) {
                Log::error('Failed to initialize default categories.', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                throw new RegisterUseCaseException(
                    errorType: RegisterUseCaseException::CATEGORY_INITIALIZATION_FAILED,
                    message: 'Failed to initialize default categories.',
                );
            }

            return new RegisterUseCaseResponse(user: $user, token: $token);
        });
    }
}
