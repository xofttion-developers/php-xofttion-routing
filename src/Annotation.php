<?php

namespace Xofttion\Routing;

class Annotation
{
    // Constantes de la clase Annotation

    public const HTTP = '@http';

    public const ROUTE = '@route';

    // Atributos de la clase Annotation

    private string $method;

    private string $route;

    private string $http;

    // Constructor de la clase Annotation

    public function __construct(string $method, string $route, string $http)
    {
        $this->method = $method;
        $this->route = $route;
        $this->http = $http;
    }

    // Métodos de la clase Annotation

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getHttp(): string
    {
        return $this->http;
    }
}
