<?php
declare(strict_types=1);

namespace doganoo\SimpleRbac\Factory\Service;

use doganoo\SimpleRbac\Repository\RbacRepositoryInterface;
use doganoo\SimpleRbac\Service\RbacService;
use doganoo\SimpleRbac\Service\RbacServiceInterface;
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