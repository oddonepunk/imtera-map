<?php

namespace App\Auth\DTO;

use App\Models\Auth\User;

class UserDTO {
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $login,
        public readonly string $email,
        public readonly ?string $password = null
    ) {}

    public static function fromRequest(array $data): self {
        return new self(
            id: null,
            name: $data['name'],
            login: $data['login'],
            email: $data['email'],
            password: $data['password'] ?? null
        );
    }

    public static function fromModel(User $user): self {
        return new self(
            id: $user->id,
            name: $user->name,
            login: $user->login,
            email: $user->email
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
            'email' => $this->email,
        ];
    }
}