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


use doganoo\PHPAlgorithms\Common\Exception\InvalidKeyTypeException;
use doganoo\PHPAlgorithms\Common\Exception\UnsupportedKeyTypeException;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use doganoo\SimpleRBAC\Common\IContext;
use doganoo\SimpleRBAC\Common\IUser;
use JsonSerializable;

/**
 * Class Context
 * @package doganoo\SimpleRBAC\Test\DataProvider
 */
class Context implements IContext, JsonSerializable {
    /** @var HashTable|null $attributes */
    private $attributes = null;

    /**
     * Context constructor.
     */
    public function __construct() {
        $this->attributes = new HashTable();
    }

    /**
     * the user for whom the check should made
     *
     * @param IUser $user
     * @throws InvalidKeyTypeException
     * @throws UnsupportedKeyTypeException
     */
    public function addUser(IUser $user): void {
        $this->attributes->put(IContext::USER, $user);
    }

    /**
     * returns an attribute
     *
     * @param string $name
     * @return mixed
     * @throws InvalidKeyTypeException
     * @throws UnsupportedKeyTypeException
     */
    public function getAttribute(string $name) {
        return $this->attributes->get($name);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return [
            "attributes" => $this->attributes
        ];
    }
}
