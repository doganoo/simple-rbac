<?php
declare(strict_types=1);

namespace doganoo\SimpleRBAC\Repository;

use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use doganoo\SimpleRBAC\Entity\UserInterface;

interface RBACRepositoryInterface {

    public function getRolesByUser(UserInterface $user): HashTable;

    public function getPermissionsByRoleId(int $roleId): HashTable;

}