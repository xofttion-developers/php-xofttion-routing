<?php

namespace Xofttion\Routing;

class Endpoint
{
    private string $controller;

    private Annotation $annotation;

    public function __construct(string $controller, Annotation $annotation)
    {
        $this->controller = $controller;
        $this->annotation = $annotation;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getRoute(): string
    {
        return $this->getAnnotation()->getRoute();
    }

    public function getHttp(): string
    {
        return $this->getAnnotation()->getHttp();
    }

    public function getMethod(): string
    {
        return $this->getAnnotation()->getMethod();
    }

    public function getAnnotation(): Annotation
    {
        return $this->annotation;
    }

    public function getAction(): string
    {
        return "{$this->getController()}@{$this->getMethod()}";
    }
}
