<?php
declare(strict_types=1);

namespace doganoo\SimpleRbac;

use doganoo\SimpleRbac\Factory\Service\RbacServiceFactory;
use doganoo\SimpleRbac\Service\RbacService;
use doganoo\SimpleRbac\Service\RbacServiceInterface;

final class ConfigProvider {

    public function __invoke(): array {
        return [
            'dependencies' => [
                'factories' => [
                    RbacService::class => RbacServiceFactory::class
                ],
                'aliases'   => [
                    RbacServiceInterface::class => RbacService::class
                ]
            ]
        ];
    }

}