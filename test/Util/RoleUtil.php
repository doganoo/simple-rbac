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

namespace doganoo\SimpleRBAC\Test\Util;

use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinarySearchTree;
use doganoo\SimpleRBAC\Common\IRole;
use doganoo\SimpleRBAC\Test\DataProvider\Role;

/**
 * Class RoleUtil
 *
 * @package Util
 */
class RoleUtil {

    /**
     * RoleUtil constructor.
     */
    private function __construct() {
    }

    /**
     * @param int $number
     * @return BinarySearchTree
     */
    public static function getRoles(int $number = 10): BinarySearchTree {
        $binarySearchTree = new BinarySearchTree();
        for ($i = 1; $i <= $number; $i++) {
            $binarySearchTree->insertValue(RoleUtil::toRole($i));
        }
        return $binarySearchTree;
    }

    /**
     * @param int $id
     * @return IRole
     */
    public static function toRole(int $id): IRole {
        $role = new Role();
        $role->setId($id);
        $role->setName("simple-rbac-unit-test");
        return $role;
    }

}