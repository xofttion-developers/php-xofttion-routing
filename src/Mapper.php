<?php

namespace Xofttion\Routing;

use Illuminate\Routing\Route;
use Illuminate\Routing\Router;

class Mapper
{
    private Router $router;

    private function __construct(Router $router)
    {
        $this->router = $router;
    }

    public static function build(Router $router): self
    {
        return new static($router);
    }

    public function reader(string $controller, array $middlewares = null): void
    {
        $endpoints = $this->getEndpoints($controller);

        foreach ($endpoints as $endpoint) {
            $this->attach($endpoint, $middlewares);
        }
    }

    protected function getEndpoints(string $controller): array
    {
        $annotations = Reader::controller($controller);

        $endpoints = [];

        foreach ($annotations as $annotation) {
            $endpoint = new Endpoint($controller, $annotation);

            $endpoints[] = $endpoint;
        }

        return $endpoints;
    }

    private function attach(Endpoint $endpoint, array $middlewares = null): void
    {
        $route = $this->getRoute($endpoint);

        $routeMiddlewares = $this->getMiddlewares($endpoint, $middlewares);

        $route->middleware($routeMiddlewares);
    }

    protected function getRoute(Endpoint $endpoint): Route
    {
        $action = $endpoint->getAction();
        $route = $endpoint->getRoute();

        switch ($endpoint->getHttp()) {
            case (Method::POST):
                return $this->router->post($route, $action);

            case (Method::GET):
                return $this->router->get($route, $action);

            case (Method::PUT):
                return $this->router->put($route, $action);

            case (Method::DELETE):
                return $this->router->delete($route, $action);

            default:
                return $this->router->get($route, $action);
        }
    }

    protected function getMiddlewares(Endpoint $endpoint, array $middlewares = null): array
    {
        return [];
    }
}
