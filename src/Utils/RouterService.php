<?php

namespace Rami\SeoBundle\Utils;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouterInterface;

class RouterService implements RouterServiceInterface
{
    public function __construct(
        private RouterInterface $router
    ) {
    }

    public function getRoutes(): array|RouteCollection
    {
        $routes = $this->router->getRouteCollection();
        foreach ($routes as $routeName => $route) {
//            dump($route->getMethods());
        }

        return $routes;
    }
}