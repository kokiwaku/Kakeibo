<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\UseCase\AuthResigterUseCase;
use App\UseCase\AuthResigterUseCaseRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use App\Domain\Auth\Model\Value\Password;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, AuthResigterUseCase $authResigterUseCase)
    {
        $params = $request->validated();

        $authResigterUseCaseRequest = new AuthResigterUseCaseRequest(
            email: $params['email'],
            name: $params['name'],
            password: new Password($params['password']),
        );
        $authResigterResponse = $authResigterUseCase->execute($authResigterUseCaseRequest);

        $response = response()->json(['user' => $authResigterResponse->user], 200);
        $response->cookie('auth_token', $authResigterResponse->token, 60, '/', null, false, true);

        return $response;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateToken()
    {
        try {
            $user = Auth::authenticate();
        } catch (AuthenticationException $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // 認証成功
        return response()->json(null, 204);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        try {
            $token = Auth::attempt($credentials);
            if (! $token) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Cloud not create token'], 501);
        }

        $response = response()->json()->cookie('auth_token', $token, 60, '/', null, false, true);
        return $response;
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
