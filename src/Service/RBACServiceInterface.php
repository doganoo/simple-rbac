<?php
declare(strict_types=1);

namespace doganoo\SimpleRBAC\Service;

use doganoo\SimpleRBAC\Entity\PermissionInterface;
use doganoo\SimpleRBAC\Entity\RoleInterface;
use doganoo\SimpleRBAC\Entity\UserInterface;

interface RBACServiceInterface {

    public function getPermission(int $permissionId): PermissionInterface;

    public function hasPermission(UserInterface $user, PermissionInterface $permission): bool;

    public function hasRole(UserInterface $user, RoleInterface $role): bool;

}