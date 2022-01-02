<?php

namespace Xofttion\Routing;

use Illuminate\Routing\Route;
use Illuminate\Routing\Router;

class Mapper
{
    // Atributos de la clase Mapper

    private Router $router;

    // Constructor de la clase Mapper

    private function __construct(Router $router)
    {
        $this->router = $router;
    }

    // Métodos estáticos de la clase Mapper

    public static function build(Router $router): self
    {
        return new static($router);
    }

    // Métodos estátics de la clase Mapper

    public function reader(string $controller, array $middlewares = null): void
    {
        $endPoints = $this->getEndPoints($controller);

        foreach ($endPoints as $endPoint) {
            $this->attach($endPoint, $middlewares);
        }
    }

    protected function getEndPoints(string $controller): array
    {
        $annotations = Reader::controller($controller);

        $endPoints = [];

        foreach ($annotations as $annotation) {
            $endPoint = new EndPoint($controller, $annotation);

            $endPoints[] = $endPoint;
        }

        return $endPoints;
    }

    private function attach(EndPoint $endPoint, array $middlewares = null): void
    {
        $route = $this->getRoute($endPoint);

        $routeMiddlewares = $this->getMiddlewares($endPoint, $middlewares);

        $route->middleware($routeMiddlewares);
    }

    protected function getRoute(EndPoint $endPoint): Route
    {
        $action = $endPoint->getAction();
        $route = $endPoint->getRoute();

        switch ($endPoint->getHttp()) {
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

    protected function getMiddlewares(EndPoint $endPoint, array $middlewares = null): array
    {
        return [];
    }
}
