<?php
declare(strict_types=1);

namespace doganoo\SimpleRBAC;

use doganoo\SimpleRBAC\Factory\Service\RBACServiceFactory;
use doganoo\SimpleRBAC\Service\RBACService;
use doganoo\SimpleRBAC\Service\RBACServiceInterface;

final class ConfigProvider {

    public function __invoke(): array {
        return [
            'dependencies' => [
                'factories' => [
                    RBACService::class => RBACServiceFactory::class
                ],
                'aliases'   => [
                    RBACServiceInterface::class => RBACService::class
                ]
            ]
        ];
    }

}