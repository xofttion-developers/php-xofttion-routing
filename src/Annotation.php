<?php

namespace Xofttion\Routing;

class Annotation
{
    public const ROUTE = '@route';

    public const HTTP = '@http';

    private string $method;

    private string $route;

    private string $http;

    public function __construct(string $method, string $route, string $http)
    {
        $this->method = $method;
        $this->http = $http;
        $this->route = $route;
    }

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
