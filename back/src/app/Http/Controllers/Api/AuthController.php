<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\UseCase\Auth\LoginUseCaseRequest;
use App\UseCase\Auth\RegisterUseCase;
use App\UseCase\Auth\RegisterUseCaseRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use App\Domain\Auth\Model\Value\Password;
use App\UseCase\Auth\LoginUseCase;
use App\UseCase\Auth\ValidateTokenUseCase;

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
        $resigterResponse = $registerUseCase->execute($registerUseCaseRequest);

        $response = response()->json(['user' => $resigterResponse->user], 200);
        $response->cookie('auth_token', $resigterResponse->token, 60, '/', null, false, true);

        return $response;
    }

    public function login(LoginRequest $request, LoginUseCase $loginUseCase)
    {
        $params = $request->validated();

        try {
            $loginUseCaseRequest = new LoginUseCaseRequest($params['email'], new Password($params['password']));
            $loginUseCaseResponse = $loginUseCase->execute($loginUseCaseRequest);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => [
                    'type' => 'login_error',
                    'message' => $e->getMessage(),
                ]
            ], 403);
        }

        $response = response()->json()->cookie('auth_token', $loginUseCaseResponse->token, 60, '/', null, false, true);
        return $response;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateToken(ValidateTokenUseCase $validateTokenUseCase)
    {
        try {
            $validateTokenUseCase->execute();
        } catch (AuthenticationException $e) {
            return response()->json([
                'status' => 'error',
                'error' => [
                    'type' => 'invalidate_token',
                    'message' => $e->getMessage(),
                ]
            ], 403);
        }

        // 認証成功
        return response()->json(null, 204);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::invalidate(Auth::getToken());

        return response()->json(['message' => 'Successfully logged out']);
    }
}
