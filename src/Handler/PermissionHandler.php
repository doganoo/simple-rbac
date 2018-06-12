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

namespace doganoo\SimpleRBAC\Handler;

use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinarySearchTree;
use doganoo\SimpleRBAC\Common\IDataProvider;
use doganoo\SimpleRBAC\Object\Permission;

/**
 * Class PermissionHandler
 *
 * @package doganoo\SimpleRBAC\Handler
 */
class PermissionHandler {
    /** @var IDataProvider $dataProvider */
    private $dataProvider = null;

    /**
     * PermissionHandler constructor.
     *
     * @param IDataProvider $dataProvider
     */
    public function __construct(IDataProvider $dataProvider) {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @param Permission $permission
     * @return bool
     * @throws \doganoo\PHPAlgorithms\common\Exception\InvalidKeyTypeException
     * @throws \doganoo\PHPAlgorithms\common\Exception\UnsupportedKeyTypeException
     */
    public function hasPermission(Permission $permission): bool {
        $user = $this->dataProvider->getUser();
        if (null === $user) {
            return false;
        }
        if ($this->isDefaultPermission($permission)) {
            return true;
        }
        $permissions = $user->getPermissions();
        $permission = $permissions->search($permission->getId());
        return null !== $permission;
    }

    /**
     * @param Permission $permission
     * @return bool
     * @throws \doganoo\PHPAlgorithms\common\Exception\InvalidKeyTypeException
     * @throws \doganoo\PHPAlgorithms\common\Exception\UnsupportedKeyTypeException
     */
    private function isDefaultPermission(Permission $permission) {
        $defaultPermissionsMap = $this->dataProvider->getDefaultPermissions();
        $node = $defaultPermissionsMap->getNodeByKey(IDataProvider::ALL_PERMISSIONS);
        if (null === $node) {
            return false;
        }
        /** @var null|BinarySearchTree $defaultPermissions */
        $defaultPermissions = $node->getValue();
        if (null === $defaultPermissions) {
            return false;
        }
        $permission = $defaultPermissions->search($permission->getId());
        if (null === $permission) {
            return false;
        }
        return true;
    }

}