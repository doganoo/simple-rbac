<?php
declare(strict_types=1);

namespace doganoo\SimpleRBAC\Factory\Service;

use doganoo\SimpleRBAC\Repository\RbacRepositoryInterface;
use doganoo\SimpleRBAC\Service\RbacService;
use doganoo\SimpleRBAC\Service\RbacServiceInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class RbacServiceFactory implements FactoryInterface {

    public function __invoke(
        ContainerInterface $container
        ,                  $requestedName
        , ?array           $options = null
    ): RbacServiceInterface {
        return new RbacService(
            $container->get(RbacRepositoryInterface::class)
        );
    }

}