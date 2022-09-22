<?php
declare(strict_types=1);

namespace doganoo\SimpleRBAC\Factory\Service;

use doganoo\SimpleRBAC\Repository\RBACRepositoryInterface;
use doganoo\SimpleRBAC\Service\RBACService;
use doganoo\SimpleRBAC\Service\RBACServiceInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class RBACServiceFactory implements FactoryInterface {

    public function __invoke(
        ContainerInterface $container
        ,                  $requestedName
        , ?array           $options = null
    ): RBACServiceInterface {
        return new RBACService(
            $container->get(RBACRepositoryInterface::class)
        );
    }

}