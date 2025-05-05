<?php
declare(strict_types=1);

namespace doganoo\SimpleRBAC;

use doganoo\SimpleRBAC\Factory\Service\RbacServiceFactory;
use doganoo\SimpleRBAC\Service\RbacService;
use doganoo\SimpleRBAC\Service\RbacServiceInterface;

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