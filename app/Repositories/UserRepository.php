<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): object
    {
        return User::create($data);
    }

    public function findByEmail(string $email): ?object
    {
        return User::where('email', $email)->first();
    }

    public function all(): iterable
    {
        return User::all();
    }
}
