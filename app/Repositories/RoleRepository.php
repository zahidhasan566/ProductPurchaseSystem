<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function assignRole(string $role): string
    {
        return in_array($role, ['user', 'admin']) ? $role : 'user';
    }

    public function isRoleAllowed(string $userRole, array $allowedRoles): bool
    {
        return in_array($userRole, $allowedRoles);
    }
}
