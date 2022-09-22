<?php
declare(strict_types=1);

namespace doganoo\SimpleRBAC\Repository;

use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use doganoo\SimpleRBAC\Entity\RoleInterface;
use doganoo\SimpleRBAC\Entity\UserInterface;

interface RBACRepositoryInterface {

    public function getRolesByUser(UserInterface $user): HashTable;

    public function getPermissionsByRole(RoleInterface $role): HashTable;

}