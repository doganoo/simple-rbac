<?php
declare(strict_types=1);

namespace doganoo\SimpleRbac\Service;

use doganoo\SimpleRbac\Entity\PermissionInterface;
use doganoo\SimpleRbac\Entity\RoleInterface;
use doganoo\SimpleRbac\Entity\UserInterface;
use doganoo\SimpleRbac\Repository\RbacRepositoryInterface;

class RbacService implements RbacServiceInterface {

    private RbacRepositoryInterface $rbacRepository;

    public function __construct(
        RbacRepositoryInterface $rbacRepository
    ) {
        $this->rbacRepository = $rbacRepository;
    }

    public function getPermission(int $permissionId): PermissionInterface {
        return $this->rbacRepository->getPermission($permissionId);
    }

    public function hasPermission(UserInterface $user, PermissionInterface $permission): bool {
        /** @var RoleInterface $role */
        foreach ($user->getRoles()->toArray() as $role) {
            if (true === $role->getPermissions()->contains($permission)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole(UserInterface $user, RoleInterface $role): bool {
        return $user->getRoles()->contains($role);
    }

}