<?php

namespace Xofttion\Routing;

class Annotation
{
    public const HTTP = '@http';

    public const ROUTE = '@route';

    private string $method;

    private string $route;

    private string $http;

    public function __construct(string $method, string $route, string $http)
    {
        $this->method = $method;
        $this->route = $route;
        $this->http = $http;
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
