<?php

namespace SydVic\Framework\Http\Middleware;

use SydVic\Framework\Http\Request;
use SydVic\Framework\Http\Response;
use SydVic\framework\Routing\RouterInterface;
use Psr\Container\ContainerInterface;

class RouterDispatch implements MiddlewareInterface
{

    public function __construct(
        private RouterInterface $router,
        private ContainerInterface $container,
    )
    {
    }

    public function process(Request $request, RequestHandlerInterface $requestHandler): Response
    {
        [$routeHandler, $vars] = $this->router->dispatch($request, $this->container);

        $response = call_user_func_array($routeHandler, $vars);

        return $response;
    }
}