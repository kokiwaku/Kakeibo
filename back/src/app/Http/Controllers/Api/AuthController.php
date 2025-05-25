<?php

namespace App\Http\Controllers\Api;

use App\Domain\Auth\Exception\LoginUseCaseException;
use App\Domain\Auth\Exception\LogoutUseCaseException;
use App\Domain\Auth\Exception\RegisterUseCaseException;
use App\Domain\Auth\Exception\ValidateTokenUseCaseException;
use App\Domain\Auth\Exception\UserInfoUseCaseException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\UseCase\Auth\LoginUseCaseRequest;
use App\UseCase\Auth\LogoutUseCaseRequest;
use App\UseCase\Auth\RegisterUseCase;
use App\UseCase\Auth\RegisterUseCaseRequest;
use App\Domain\Auth\Model\Value\Password;
use App\UseCase\Auth\LoginUseCase;
use App\UseCase\Auth\LogoutUseCase;
use App\UseCase\Auth\ValidateTokenUseCase;
use App\UseCase\Auth\ValidateTokenUseCaseRequest;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domain\Auth\Model\Entity\User;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterUseCase $registerUseCase)
    {
        $params = $request->validated();

        $registerUseCaseRequest = new RegisterUseCaseRequest(
            email: $params['email'],
            name: $params['name'],
            password: new Password($params['password']),
        );
        try {
            $resigterResponse = $registerUseCase->execute($registerUseCaseRequest);
        } catch (Throwable $e) {
            if ($e instanceof RegisterUseCaseException) {
                return response()->json([
                    'status' => 'error',
                    'error' => [
                        'type' => $e->getErrorType(),
                        'message' => [$e->getMessage()],
                    ]
                ], status: $e->getCode());
            }

            return response()->json([
                'status' => 'error',
                'error' => [
                    'type' => 'server_error',
                    'message' => 'An unexpected error occurred.',
                ]
            ], 500);
        }

        // 正常系
        $response = response()->json([
            'status' => 'success',
            'data' => [
                'user' => $resigterResponse->user,
            ],
        ], 200);

        // TODO 動作環境毎に設定値を切り替えるように
        $response->cookie('auth_token', $resigterResponse->token, 60, '/', null, false, true);

        return $response;
    }

    public function login(LoginRequest $request, LoginUseCase $loginUseCase)
    {
        $params = $request->validated();

        try {
            $loginUseCaseRequest = new LoginUseCaseRequest($params['email'], new Password($params['password']));
            $loginUseCaseResponse = $loginUseCase->execute($loginUseCaseRequest);
        } catch (Throwable $e) {
            if ($e instanceof LoginUseCaseException) {
                return response()->json([
                    'status' => 'error',
                    'error' => [
                        'type' => $e->getErrorType(),
                        'message' => [$e->getMessage()],
                    ]
                ], status: $e->getCode());
            }

            return response()->json([
                'status' => 'error',
                'error' => [
                    'type' => 'server_error',
                    'message' => ['An unexpected error occurred.'],
                ]
            ], 500);
        }

        $response = response()->json()->cookie('auth_token', $loginUseCaseResponse->token, 60, '/', null, false, true);
        return $response;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateToken(Request $request, ValidateTokenUseCase $validateTokenUseCase)
    {
        try {
            $token = $request->cookie('auth_token');
            $validateTokenUseCaseRequest = new ValidateTokenUseCaseRequest($token);
            $validateTokenUseCase->execute($validateTokenUseCaseRequest);
        } catch (Throwable $e) {
            if ($e instanceof ValidateTokenUseCaseException) {
                return response()->json([
                    'status' => 'error',
                    'error' => [
                        'type' => $e->getErrorType(),
                        'message' => [$e->getMessage()],
                    ]
                ], status: $e->getCode());
            }

            return response()->json([
                'status' => 'error',
                'error' => [
                    'type' => 'server_error',
                    'message' => ['An unexpected error occurred.'],
                ]
            ], 500);
        }

        // 認証成功
        return response()->json(null, 204);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request, LogoutUseCase $logoutUseCase)
    {
        try {
            $token = $request->cookie('auth_token');
            $logoutUseCaseRequest = new LogoutUseCaseRequest($token);
            $logoutUseCase->execute($logoutUseCaseRequest);
        } catch (Throwable $e) {
            if ($e instanceof LogoutUseCaseException) {
                return response()->json([
                    'status' => 'error',
                    'error' => [
                        'type' => $e->getErrorType(),
                        'message' => [$e->getMessage()],
                    ]
                ], status: $e->getCode());
            }

            return response()->json([
                'status' => 'error',
                'error' => [
                    'type' => 'server_error',
                    'message' => ['An unexpected error occurred.'],
                ]
            ], 500);
        }

        // ログアウト成功
        // tokenを削除
        return response()->json(null, 204)->cookie('auth_token', null, -1);
    }

    /**
     * 認証済みユーザーの情報を返す
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserInfo()
    {
        // 認証済みユーザーの情報を取得
        try {
            $authUser = Auth::user();
            if (!$authUser) {
                throw new UserInfoUseCaseException(
                    errorType: UserInfoUseCaseException::USER_NOT_AUTHENTICATED,
                    message: 'User is not authenticated.',
                    code: 401,
                );
            }
            $user = new User(
                id: $authUser->id,
                email: $authUser->email,
                name: $authUser->name,
                password: $authUser->password,
            );
        } catch (Throwable $e) {
            if ($e instanceof UserInfoUseCaseException) {
                return response()->json([
                    'status' => 'error',
                    'error' => [
                        'type' => $e->getErrorType(),
                        'message' => [$e->getMessage()],
                    ]
                ], status: $e->getCode());
            }

            return response()->json([
                'status' => 'error',
                'error' => [
                    'type' => 'server_error',
                    'message' => ['An unexpected error occurred.'],
                ]
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ],
        ], 200);
    }
}
