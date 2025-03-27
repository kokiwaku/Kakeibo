<?php

namespace App\Domain\Auth\Model\Value;

use Illuminate\Support\Facades\Hash;

class Password
{
    public function __construct(
        public readonly string $value,
    ) {
    }

    /**
     * passwordをハッシュ化する
     * @return string
     */
    public function hash(): string
    {
        return Hash::make($this->value);
    }
}
