<?php
declare(strict_types=1);

namespace doganoo\SimpleRbac\Service;

use doganoo\SimpleRbac\Entity\PermissionInterface;
use doganoo\SimpleRbac\Entity\RoleInterface;
use doganoo\SimpleRbac\Entity\UserInterface;

interface RbacServiceInterface {

    public function getPermission(int $permissionId): PermissionInterface;

    public function hasPermission(UserInterface $user, PermissionInterface $permission): bool;

    public function hasRole(UserInterface $user, RoleInterface $role): bool;

}