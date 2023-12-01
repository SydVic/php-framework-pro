<?php

namespace SydVic\framework\Routing;

use Psr\Container\ContainerInterface;
use SydVic\Framework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request, ContainerInterface $container);

    public function setRoutes(array $routes): void;
}
