<?php


namespace Util;


use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinarySearchTree;
use doganoo\SimpleRBAC\Common\IUser;

class UserUtil {
    /**
     * UserUtil constructor.
     */
    private function __construct() {
    }

    /**
     * @param int $id
     * @return IUser
     */
    public static function toUser(int $id): IUser {
        $x = new class implements IUser {
            private $id;
            private $roles;

            /**
             * the users identifier
             *
             * @return int
             */
            public function getId(): int {
                return $this->id;
            }

            /**
             * the user id
             *
             * @param int $id
             */
            public function setId(int $id): void {
                $this->id = $id;
            }

            /**
             * the user name
             *
             * @return string
             */
            public function getName(): string {
                return "";
            }

            /**
             * the user name
             *
             * @param string $name
             */
            public function setName(string $name): void {
                // TODO: Implement setName() method.
            }

            /**
             * returns the users roles
             *
             * @return BinarySearchTree|null
             */
            public function getRoles(): ?BinarySearchTree {
                return $this->roles;
            }

            /**
             * sets the users roles
             *
             * @param BinarySearchTree|null $roles
             */
            public function setRoles(?BinarySearchTree $roles): void {
                $this->roles = $roles;
            }
        };
        $x->setId($id);
        return $x;
    }
}