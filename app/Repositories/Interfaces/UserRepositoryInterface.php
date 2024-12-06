<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function create(array $data): object;

    public function findByEmail(string $email): ?object;

    public function all(): iterable;
}
