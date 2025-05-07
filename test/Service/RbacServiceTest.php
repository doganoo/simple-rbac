<?php
declare(strict_types=1);

namespace doganoo\SimpleRbac\Test\Service;

use DateTimeImmutable;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use doganoo\SimpleRbac\Repository\RbacRepositoryInterface;
use doganoo\SimpleRbac\Service\RbacService;
use PHPUnit\Framework\TestCase;
use UcarSolutions\Entities\Rbac\Permission;
use UcarSolutions\Entities\Rbac\Role;
use UcarSolutions\Entities\User\UserInterface;

final class RbacServiceTest extends TestCase {

    private RbacRepositoryInterface $repository;
    private RbacService             $service;

    protected function setUp(): void {
        // Mock the full interface
        $this->repository = $this->createMock(RbacRepositoryInterface::class);
        $this->service    = new RbacService($this->repository);
    }

    public function testGetPermission(): void {
        $permission = new Permission(
            id: md5((string)time()),
            name: 'permission',
            createTs: new DateTimeImmutable(),
        );
        $this->repository
            ->expects($this->once())
            ->method('getPermission')
            ->with(1)
            ->willReturn($permission);

        $result = $this->service->getPermission("1");
        $this->assertSame($permission, $result);
    }

    public function testHasPermissionReturnsTrue(): void {
        $this->markTestSkipped('skipped for now');
        $permission  = new Permission(
            id: md5((string)time()),
            name: 'permission2',
            createTs: new DateTimeImmutable(),
        );
        $permissions = new HashTable();
        $permissions->put($permission->getId(), $permission);

        $role = new Role(
            id: 1,
            name: 'role',
            permissions: $permissions,
            createTs: new DateTimeImmutable(),
        );

        $roles = new  HashTable();
        $roles->put($role->getId(), $role);

        $user = $this->createMock(UserInterface::class);
        $user->method('getRoles')->willReturn($roles);

        $this->assertTrue($this->service->hasPermission($user, $permission));
    }

    public function testHasPermissionReturnsFalse(): void {
        $this->markTestSkipped('skipped for now');
        $permission = new Permission(
            id: md5((string)time()),
            name: 'permission3',
            createTs: new DateTimeImmutable(),
        );

        $permissions = new HashTable();

        $role  = new Role(
            id: md5((string)time()),
            name: 'role',
            permissions: $permissions,
            createTs: new DateTimeImmutable(),
        );
        $roles = new  HashTable();
        $roles->put($role->getId(), $role);

        $user = $this->createMock(UserInterface::class);
        $user->method('getRoles')->willReturn($roles);

        $this->assertFalse($this->service->hasPermission($user, $permission));
    }

    public function testHasRoleReturnsTrue(): void {
        $this->markTestSkipped('skipped for now');
        $role = new Role(
            id: md5((string)time()),
            name: 'role3',
            permissions: new HashTable(),
            createTs: new DateTimeImmutable(),
        );

        $roles = new  HashTable();
        $roles->put($role->getId(), $role);

        $user = $this->createMock(UserInterface::class);
        $user->method('getRoles')->willReturn($roles);

        $this->assertTrue($this->service->hasRole($user, $role));
    }

    public function testHasRoleReturnsFalse(): void {
        $this->markTestSkipped('skipped for now');
        $permission = new Permission(
            id: md5((string)time()),
            name: 'permission',
            createTs: new DateTimeImmutable(),
        );

        $roles = [];

        $user = $this->createMock(UserInterface::class);
        $user->method('getPermissions')->willReturn($roles);

        $this->assertFalse($this->service->hasPermission($user, $permission));
    }

}
