<?php
declare(strict_types=1);

namespace doganoo\SimpleRBAC\Service;

use doganoo\SimpleRBAC\Entity\IPermission;
use doganoo\SimpleRBAC\Entity\IRole;
use doganoo\SimpleRBAC\Entity\IUser;

interface RBACServiceInterface {

    public function hasPermission(IUser $user, IPermission $permission): bool;

    public function hasRole(IUser $user, IRole $role): bool;

}