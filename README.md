# simple-rbac
Simple leightweight PHP Role Based Access Control library

## How does this library work?

I have tried to keep things simple. The main idea was to let the user implement an interface which provides the user and his permissions. The permissions are assigned to roles and roles are assigned to users. 

The library provides a simple way to verify permissions without re-inventing the wheel. Notice that the library is still in development, there are few things to optimize:

* using permission objects in BinarySearchTree instead of simple ids

The library is also available on Packagist: https://packagist.org/packages/doganoo/simple-rbac
missing something? create a pull request!
