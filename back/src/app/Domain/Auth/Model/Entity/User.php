<?php

namespace App\Domain\Auth\Model\Entity;

class User
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly string $email,
        public readonly string $name,
        public readonly string $password,
    ) {
    }
}
