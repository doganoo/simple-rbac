<?php
declare(strict_types=1);

namespace doganoo\SimpleRBAC\Service;

use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use doganoo\SimpleRBAC\Entity\IPermission;
use doganoo\SimpleRBAC\Entity\IRole;
use doganoo\SimpleRBAC\Entity\IUser;
use doganoo\SimpleRBAC\Repository\PermissionRepositoryInterface;

class RBACService implements RBACServiceInterface {

    private PermissionRepositoryInterface $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository) {
        $this->permissionRepository = $permissionRepository;
    }

    public function getRolesByUser(IUser $user): HashTable {
        return $this->permissionRepository->getRolesByUser($user);
    }

    public function getPermissionsByRole(IRole $role): HashTable {
        return $this->permissionRepository->getPermissionsByRole($role);
    }

    public function hasPermission(IUser $user, IPermission $permission): bool {
        /** @var IRole $role */
        foreach ($user->getRoles()->toArray() as $role) {
            if (true === $role->getPermissions()->contains($permission->getId())) {
                return true;
            }
        }
        return false;
    }

    public function hasRole(IUser $user, IRole $role): bool {
        return $user->getRoles()->contains($role->getId());
    }

}