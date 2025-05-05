# simple-rbac
Simple leightweight PHP Role Based Access Control library

## How does this library work?

I have tried to keep things simple. The main idea was to let the user implement an interface which provides the user and his permissions. The permissions are assigned to roles and roles are assigned to users. 

The library provides a simple way to verify permissions without re-inventing the wheel.

The library is also available on Packagist: https://packagist.org/packages/doganoo/simple-rbac

missing something? create a pull request!

## Changelog

* 1.3.0 supporting owners: 

## Installation

You can install the package via composer:

```bash
composer require doganoo/simple-rbac
```

## Usage

There are two main interfaces you have to implement:

```
* doganoo\SimpleRbac\Common\IUser
* doganoo\SimpleRbac\Common\IDataProvider
```
The first interface represents the user to whom permissions are granted or denied. The second interface holds all necessary information, such as the user, a single permission and default permissions.

IDataProvider can be used to connect to a data source (database, files, HTTP, etc.) in order to set up.

The ```doganoo\SimpleRbac\Handler\PermissionHandler``` class uses the interfaces above to determine whether an action is permitted or not.

```doganoo\SimpleRbac\Common\IPermission``` and ```doganoo\SimpleRbac\Common\IRole``` interfaces represent a single permission and a user's role.


## Contributions

Feel free to send a pull request to add more algorithms and data structures. 

## Maintainer/Creator

Doğan Uçar ([@doganoo](https://www.dogan-ucar.de))

## License

MIT
 



