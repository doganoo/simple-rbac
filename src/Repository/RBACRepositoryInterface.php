<?php
declare(strict_types=1);

namespace doganoo\SimpleRBAC\Repository;

use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayList\ArrayList;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use doganoo\SimpleRBAC\Entity\PermissionInterface;
use doganoo\SimpleRBAC\Entity\RoleInterface;
use doganoo\SimpleRBAC\Entity\UserInterface;

interface RBACRepositoryInterface {

    public function getRolesByUser(UserInterface $user): HashTable;

    public function getPermissionsByRoleId(int $roleId): HashTable;

    public function getAllPermissions(): ArrayList;

    public function getAllRoles(): ArrayList;

    public function getRole(int $roleId): RoleInterface;

    public function getPermissionByName(string $name): PermissionInterface;

    public function createRole(RoleInterface $role): RoleInterface;

    public function createPermission(PermissionInterface $permission): PermissionInterface;

}