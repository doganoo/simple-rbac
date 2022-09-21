<?php
declare(strict_types=1);

namespace doganoo\SimpleRBAC\Repository;

use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use doganoo\SimpleRBAC\Entity\IRole;
use doganoo\SimpleRBAC\Entity\IUser;

interface PermissionRepositoryInterface {

    public function getRolesByUser(IUser $user): HashTable;

    public function getPermissionsByRole(IRole $role): HashTable;

}