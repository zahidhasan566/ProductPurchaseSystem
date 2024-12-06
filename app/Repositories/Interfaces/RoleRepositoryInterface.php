<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    public function assignRole(string $role): string;

    public function isRoleAllowed(string $userRole, array $allowedRoles): bool;
}
