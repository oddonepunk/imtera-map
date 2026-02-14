<?php

namespace App\Contracts\Auth\Services;

use App\Contracts\Auth\DTO\UserDTO;


interface AuthServiceInterface {

    public function register(UserDTO $userDTO): array;
    public function login(string $login, string $password): array;
    public function refresh(string $refreshToken): array;
    public function logout(): void;
    public function me(): ?UserDTO;
}