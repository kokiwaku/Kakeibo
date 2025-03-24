<?php

namespace App\UseCase\Auth;

use Illuminate\Support\Facades\Auth;

class LogoutUseCase
{

    public function execute(LogoutUseCaseRequest $request)
    {
        Auth::invalidate($request->token);
    }
}
