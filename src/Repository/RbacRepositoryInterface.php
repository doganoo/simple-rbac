<?php
declare(strict_types=1);

namespace doganoo\SimpleRbac\Repository;

use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayList\ArrayList;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use doganoo\SimpleRbac\Entity\PermissionInterface;
use doganoo\SimpleRbac\Entity\RoleInterface;
use doganoo\SimpleRbac\Entity\UserInterface;

interface RbacRepositoryInterface {

    public function getRolesByUser(UserInterface $user): HashTable;

    public function getPermissionsByRoleId(int $roleId): HashTable;

    public function getAllPermissions(): ArrayList;

    public function getAllRoles(): ArrayList;

    public function getRole(int $roleId): RoleInterface;

    public function getPermission(int $permissionId): PermissionInterface;

    public function getPermissionByName(string $name): PermissionInterface;

    public function createRole(RoleInterface $role): RoleInterface;

    public function createPermission(PermissionInterface $permission): PermissionInterface;

    public function getRoleByName(string $name): RoleInterface;

    public function assignRoleToUser(UserInterface $user, RoleInterface $role): void;

    public function assignPermissionToRole(PermissionInterface $permission, RoleInterface $role): void;

}