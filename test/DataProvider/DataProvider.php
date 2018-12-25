<?php
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

namespace DataProvider;


use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinarySearchTree;
use doganoo\SimpleRBAC\Common\IDataProvider;
use doganoo\SimpleRBAC\Common\IPermission;
use doganoo\SimpleRBAC\Common\IUser;
use Util\PermissionUtil;
use Util\RoleUtil;

/**
 * Class DataProvider
 *
 * @package DataProvider
 */
class DataProvider implements IDataProvider {

    /**
     * the user whose permissions should be validated
     *
     * @return IUser
     */
    public function getUser(): ?IUser {
        $user = new User();
        $user->setId(1);

        $tree = new BinarySearchTree();
        $tree->insertValue(RoleUtil::toRole(5));
        $tree->insertValue(RoleUtil::toRole(4));
        $tree->insertValue(RoleUtil::toRole(7));
        $tree->insertValue(RoleUtil::toRole(3));
        $tree->insertValue(RoleUtil::toRole(6));

        $user->setRoles($tree);

        return $user;
    }

    /**
     * returns the permission object that belongs to $id
     *
     * @param int $id
     * @return Permission|null
     */
    public function getPermission(int $id): ?IPermission {
        if (in_array($id, [1, 8, 75, 19])) {
            $permission = new Permission();
            $permission->setId($id);
            $tree = new BinarySearchTree();
            $tree->insertValue(RoleUtil::toRole(9));
            $tree->insertValue(RoleUtil::toRole(5));
            $tree->insertValue(RoleUtil::toRole(13));
            $tree->insertValue(RoleUtil::toRole(4));
            $tree->insertValue(RoleUtil::toRole(7));
            $permission->setRoles($tree);
            return $permission;
        }
        return null;
    }

    /**
     * all default permissions that are public for all users
     *
     * @return null|BinarySearchTree
     */
    public function getDefaultPermissions(): ?BinarySearchTree {
        $tree = new BinarySearchTree();
        $tree->insertValue(PermissionUtil::toPermission(101));
        $tree->insertValue(PermissionUtil::toPermission(102));
        $tree->insertValue(PermissionUtil::toPermission(103));
        $tree->insertValue(PermissionUtil::toPermission(104));
        return $tree;
    }
}
