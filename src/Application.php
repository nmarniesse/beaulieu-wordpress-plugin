<?php

declare(strict_types=1);

namespace Beaulieu;

use Beaulieu\Infrastructure\ServiceContainerBuilder;
use DI\Container;

final class Application
{
    private Container $container;

    public function __construct()
    {
        $this->container = ServiceContainerBuilder::build();
    }

    public function run(string $class, array $arguments): mixed
    {
        $service = $this->container->get($class);

        return \call_user_func_array($service, $arguments);
    }
}
