<?php

namespace App\UseCase\Auth;

use Illuminate\Support\Facades\Auth;

class ValidateTokenUseCase
{

    /**
     * Summary of execute
     * @return void
     */
    public function execute(): void
    {
        Auth::authenticate();
    }
}
