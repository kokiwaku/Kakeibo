<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = Auth::authenticate();
            Auth::setUser($user);
        } catch (AuthenticationException $e) {
            return response()->json([
                'status' => 'error',
                'error' => [
                    'type' => 'unauthorized',
                    'message' => ['Unauthorized.'],
                ]
            ], 401);
        }

        return $next($request);

    }
}
