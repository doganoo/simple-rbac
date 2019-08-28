<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace doganoo\SimpleRBAC\Test\DataProvider;

use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinarySearchTree;
use doganoo\SimpleRBAC\Common\IDataProvider;
use doganoo\SimpleRBAC\Common\IPermission;
use doganoo\SimpleRBAC\Common\IUser;
use doganoo\SimpleRBAC\Test\Util\PermissionUtil;

/**
 * Class MassiveDataProvider
 *
 * @package DataProvider
 */
class MassiveDataProvider implements IDataProvider {
    private const DATA_AMOUNT = 7000;

    /**
     * the user whose permissions should be validated
     *
     * @return IUser
     */
    public function getUser(): IUser {
        $user = new User();
        $user->setId(1);
        $tree = PermissionUtil::getRoles(self::DATA_AMOUNT);
        $user->setRoles($tree);
        return $user;
    }

    /**
     * all default permissions that are public for all users
     *
     * @return null|BinarySearchTree
     */
    public function getDefaultPermissions(): ?BinarySearchTree {
        $tree = PermissionUtil::getPermissions(0);
        return $tree;
    }

    /**
     * @param int $id
     * @return IPermission|null
     */
    public function getPermission(int $id): ?IPermission {
        $permission = new Permission();
        $permission->setId($id);
        $tree = PermissionUtil::getPermissions(self::DATA_AMOUNT);
        $permission->setRoles($tree);
        return $permission;
    }
}
