<?php
declare(strict_types=1);

namespace doganoo\SimpleRbac\Test\Entity;

use DateTimeImmutable;
use doganoo\SimpleRbac\Entity\Permission;
use PHPUnit\Framework\TestCase;

final class PermissionTest extends TestCase {

    private Permission        $permission;
    private int               $id   = 1;
    private string            $name = 'view_user';
    private DateTimeImmutable $createTs;

    protected function setUp(): void {
        $this->createTs   = new DateTimeImmutable();
        $this->permission = new Permission($this->id, $this->name, $this->createTs);
    }

    public function testAll(): void {
        $this->assertSame($this->id, $this->permission->getId());
        $this->assertSame($this->name, $this->permission->getName());
        $this->assertSame($this->createTs, $this->permission->getCreateTs());
    }

}
