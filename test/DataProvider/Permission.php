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
use doganoo\SimpleRBAC\Common\IPermission;
use doganoo\SimpleRBAC\Common\IUser;

/**
 * Class Permission
 *
 * @package DataProvider
 */
class Permission implements IPermission {

    /** @var int $id */
    private $id;
    /** @var string $name */
    private $name;
    /** @var null|BinarySearchTree */
    private $roles = null;
    /** @var null|IUser */
    private $owner = null;

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @return BinarySearchTree|null
     */
    public function getRoles(): ?BinarySearchTree {
        return $this->roles;
    }

    /**
     * @param BinarySearchTree|null $roles
     */
    public function setRoles(?BinarySearchTree $roles): void {
        $this->roles = $roles;
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if (!$object instanceof IPermission) {
            return -1;
        }
        if ($this->getId() < $object->getId()) {
            return -1;
        }
        if ($this->getId() == $object->getId()) {
            return 0;
        }
        if ($this->getId() > $object->getId()) {
            return 1;
        }
        return -1;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @return IUser|null
     */
    public function getOwner(): ?IUser {
        return $this->owner;
    }

    /**
     * @param IUser $owner
     */
    public function setOwner(IUser $owner): void {
        $this->owner = $owner;
    }
}