<?php
declare(strict_types=1);
/**
 * MIT License
 * Copyright (c) 2018 Dogan Ucar
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace doganoo\SimpleRBAC\Handler;

use doganoo\PHPAlgorithms\Algorithm\Traversal\PreOrder;
use doganoo\PHPAlgorithms\Common\Exception\InvalidBitLengthException;
use doganoo\PHPAlgorithms\Common\Exception\InvalidSearchComparisionException;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinarySearchTree;
use doganoo\PHPAlgorithms\Datastructure\Vector\BitVector\IntegerVector;
use doganoo\SimpleRBAC\Common\IDataProvider;
use doganoo\SimpleRBAC\Common\IPermission;
use doganoo\SimpleRBAC\Common\IPermissionHandler;
use doganoo\SimpleRBAC\Common\IRole;
use doganoo\SimpleRBAC\Common\IUser;

/**
 * Class PermissionHandler
 *
 * @package doganoo\SimpleRBAC\Handler
 */
class PermissionHandler implements IPermissionHandler {
    /** @var IDataProvider $dataProvider */
    private $dataProvider = null;
    /** @var IntegerVector|null $permissionVector */
    private $permissionVector = null;
    /** @var IntegerVector|null $defaultPermissionVector */
    private $defaultPermissionVector = null;
    /** @var IntegerVector|null $roleVector */
    private $roleVector = null;

    /**
     * PermissionHandler constructor.
     *
     * @param IDataProvider $dataProvider
     *
     * @throws InvalidBitLengthException
     */
    public function __construct(IDataProvider $dataProvider) {
        $this->dataProvider = $dataProvider;
        $this->permissionVector = new IntegerVector();
        $this->defaultPermissionVector = new IntegerVector();
        $this->roleVector = new IntegerVector();
    }

    /**
     * returns a boolean that determines whether the user has the permission or not
     * TODO break the traversal when $found is true
     *
     * @param IPermission $permission
     *
     * @return bool
     * @throws InvalidSearchComparisionException
     */
    public function hasPermission(IPermission $permission): bool {
        //notice that there is no null check necessary since the
        //method declaration does not allow $permission to be null
        if ($this->isDefaultPermission($permission)) return true;
        $user = $this->dataProvider->getUser();
        if (null === $user) return false;
        if (null === $user->getRoles()) return false;
        if ($this->permissionVector->get($permission->getId())) return true;
        //if the permission (the item) has a owner,
        //then we grant this permission to the owner.
        //In this case, it does not matter whether the
        //user granted the permission explicitly or not.
        if ($this->isOwner($user, $permission->getOwner())) return true;
        $roles = $user->getRoles();
        $traversal = new PreOrder($roles);
        $found = false;
        $traversal->setCallable(
            function ($userRoleId) use ($permission, &$found) {
                $permissionRoles = $permission->getRoles();
                if (null !== $permissionRoles) {
                    $node = $permissionRoles->search($userRoleId);
                    if (null !== $node) {
                        $found = true;
                        $this->permissionVector->set($permission->getId());
                    }
                }
            });
        $traversal->traverse();
        return $found;
    }

    /**
     * returns a boolean whether the permission is a default permission or not
     * (for public menu entries, e.g.)
     *
     * @param IPermission $permission
     *
     * @return bool
     * @throws InvalidSearchComparisionException
     */
    private function isDefaultPermission(?IPermission $permission): bool {
        if ($this->defaultPermissionVector->get($permission->getId())) return true;
        /** @var null|BinarySearchTree $defaultPermissionsMap */
        $defaultPermissionsTree = $this->dataProvider->getDefaultPermissions();
        if (null === $defaultPermissionsTree) return false;
        $node = $defaultPermissionsTree->search($permission);
        if (null === $node) return false;
        $this->defaultPermissionVector->set($permission->getId());
        return true;
    }

    /**
     * @param IUser|null $currentUser
     * @param IUser|null $permissionUser
     * @return bool
     */
    private function isOwner(?IUser $currentUser, ?IUser $permissionUser): bool {
        if (null === $currentUser) return false;
        if (null === $permissionUser) return false;
        return $currentUser->getId() === $permissionUser->getId();
    }

    /**
     * @param IRole $role
     *
     * @return bool
     * @throws InvalidSearchComparisionException
     */
    public function hasRole(IRole $role): bool {
        if ($this->roleVector->get($role->getId())) return true;
        $user = $this->dataProvider->getUser();
        if (null === $user) return false;
        if (null === $user->getRoles()) return false;
        $roles = $user->getRoles();
        $node = $roles->search($role);
        if (null === $node) return false;
        $this->roleVector->set($role->getId());
        return true;
    }
}