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

namespace Util;

use DataProvider\Permission;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinarySearchTree;
use doganoo\SimpleRBAC\Common\IPermission;

/**
 * Class PermissionUtil
 *
 * @package Util
 */
class PermissionUtil {
    /**
     * PermissionUtil constructor.
     */
    public function __construct() {
    }

    /**
     * @param int $number
     * @return BinarySearchTree
     */
    public static function getPermissions(int $number = 10) {
        $searchTree = new BinarySearchTree();
        for ($i = 0; $i < $number; $i++) {
            $searchTree->insertValue(PermissionUtil::toPermission($i));
        }
        return $searchTree;
    }

    /**
     * @param int $id
     * @param int|null $owner
     * @return IPermission
     */
    public static function toPermission(int $id, int $owner = null): IPermission {
        $permission = new Permission();
        $permission->setId($id);
        if (null !== $owner) {
            $owner = UserUtil::toUser($owner);
            $permission->setOwner($owner);
        }
        return $permission;
    }

    /**
     * @param IPermission $permission
     * @param int $number
     * @return IPermission
     */
    public static function addRoles(IPermission $permission, int $number = 10): IPermission {
        $permission->setRoles(RoleUtil::getRoles($number));
        return $permission;
    }

    /**
     * @param int $number
     * @return BinarySearchTree
     */
    public static function getRoles(int $number = 10): BinarySearchTree {
        $searchTree = new BinarySearchTree();
        for ($i = 1; $i <= $number; $i++) {
            $searchTree->insertValue(PermissionUtil::toPermission($i));
        }
        return $searchTree;
    }
}