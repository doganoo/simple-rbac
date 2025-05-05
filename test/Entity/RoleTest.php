<?php
declare(strict_types=1);

namespace doganoo\SimpleRbac\Test\Entity;

use DateTimeImmutable;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use PHPUnit\Framework\TestCase;
use UcarSolutions\Entities\User\Rbac\Role;

final class RoleTest extends TestCase {

    private Role              $role;
    private int               $id   = 1;
    private string            $name = 'admin';
    private HashTable         $permissions;
    private DateTimeImmutable $createTs;

    protected function setUp(): void {
        $this->permissions = new HashTable();
        $this->createTs    = new DateTimeImmutable();
        $this->role        = new Role($this->id, $this->name, $this->permissions, $this->createTs);
    }

    public function testAll(): void {
        $this->assertSame($this->id, $this->role->getId());
        $this->assertSame($this->name, $this->role->getName());
        $this->assertSame($this->permissions, $this->role->getPermissions());
        $this->assertSame($this->createTs, $this->role->getCreateTs());
    }

}
