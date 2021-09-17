<?php

namespace Xofttion\Routing;

class EndPoint
{

    // Atributos de la clase EndPoint

    /**
     *
     * @var string 
     */
    private $controller;

    /**
     *
     * @var string 
     */
    private $http;

    /**
     *
     * @var string 
     */
    private $route;

    /**
     *
     * @var string 
     */
    private $function;

    // Métodos de la clase EndPoint

    /**
     * 
     * @param string $controller
     * @return void
     */
    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * 
     * @return string|null
     */
    public function getController(): ?string
    {
        return $this->controller;
    }

    /**
     * 
     * @param string $http
     * @return void
     */
    public function setHttp(string $http): void
    {
        $this->http = $http;
    }

    /**
     * 
     * @return string|null
     */
    public function getHttp(): ?string
    {
        return $this->http;
    }

    /**
     * 
     * @param string $route
     * @return void
     */
    public function setRoute(string $route): void
    {
        $this->route = $route;
    }

    /**
     * 
     * @return string|null
     */
    public function getRoute(): ?string
    {
        return $this->route;
    }

    /**
     * 
     * @param string $function
     * @return void
     */
    public function setFunction(string $function): void
    {
        $this->function = $function;
    }

    /**
     * 
     * @return string|null
     */
    public function getFunction(): ?string
    {
        return $this->function;
    }

    /**
     * 
     * @return string
     */
    public function getProcess(): string
    {
        return "{$this->getController()}@{$this->getFunction()}";
    }
}
