<?php

namespace doganoo\SimpleRbac\Entity;

use DateTimeInterface;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;

class Role implements RoleInterface {

    public function __construct(
        private int               $id,
        private string            $name,
        private HashTable         $permissions,
        private DateTimeInterface $createTs,
    ) {
    }

    public function compareTo($object): int {
        return false;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPermissions(): HashTable {
        return $this->permissions;
    }

    public function getCreateTs(): DateTimeInterface {
        return $this->createTs;
    }


}