<?php
declare(strict_types=1);

namespace doganoo\SimpleRBAC\Service;

use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use doganoo\SimpleRBAC\Entity\PermissionInterface;
use doganoo\SimpleRBAC\Entity\RoleInterface;
use doganoo\SimpleRBAC\Entity\UserInterface;
use doganoo\SimpleRBAC\Repository\RBACRepositoryInterface;

class RBACService implements RBACServiceInterface {

    private RBACRepositoryInterface $permissionRepository;

    public function __construct(RBACRepositoryInterface $permissionRepository) {
        $this->permissionRepository = $permissionRepository;
    }

    public function getRolesByUser(UserInterface $user): HashTable {
        return $this->permissionRepository->getRolesByUser($user);
    }

    public function getPermissionsByRole(RoleInterface $role): HashTable {
        return $this->permissionRepository->getPermissionsByRole($role);
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