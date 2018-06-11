# simple-rbac
Simple leightweight PHP Role Based Access Control library

## How does this library work?

I have tried to keep things simple. The main idea was to let the user implement an interface which provides the user and his permissions. The permissions are assigned to roles and roles are assigned to users. 

The library provides a simple way to verify permissions without re-inventing the wheel. Notice that the library is still in development, there are few things to optimize:

* using permission objects in BinarySearchTree instead of simple ids
* handling roles and permissions on source code basis (currently the library expects this is done on user side (e.g. SQL) and it only receives permissions)

missing something? create a pull request!
