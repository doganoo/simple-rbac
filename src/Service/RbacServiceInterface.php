<?php
declare(strict_types=1);

namespace doganoo\SimpleRbac\Service;

use UcarSolutions\Entities\Rbac\PermissionInterface;
use UcarSolutions\Entities\Rbac\RoleInterface;
use UcarSolutions\Entities\User\UserInterface;

interface RbacServiceInterface {

    public function getPermission(string $permissionId): PermissionInterface;

    public function hasPermission(UserInterface $user, PermissionInterface $permission): bool;

    public function hasRole(UserInterface $user, RoleInterface $role): bool;

}