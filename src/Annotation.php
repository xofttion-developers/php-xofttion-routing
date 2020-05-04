<?php

namespace Xofttion\Routing;

class Annotation {
    
    // Atributos de la clase Annotation
    
    /**
     *
     * @var string 
     */
    private $function;
    
    /**
     *
     * @var string 
     */
    private $route;
    
    /**
     *
     * @var string 
     */
    private $http;
    
    // Constantes de la clase Annotation
    
    const FUNCTION   = "@function";
    
    const HTTP       = "@http";
    
    const ROUTE      = "@route";
    
    // Métodos de la clase Annotation
    
    /**
     * 
     * @param string $function
     * @return void
     */
    public function setFunction(string $function): void {
        $this->function = $function;
    }
    
    /**
     * 
     * @return string|null
     */
    public function getFunction(): ?string {
        return $this->function;
    }
    
    /**
     * 
     * @param string $route
     * @return void
     */
    public function setRoute(string $route): void {
        $this->route = $route;
    }
    
    /**
     * 
     * @return string|null
     */
    public function getRoute(): ?string {
        return $this->route;
    }
    
    /**
     * 
     * @param string $http
     * @return void
     */
    public function setHttp(string $http): void {
        $this->http = $http;
    }
    
    /**
     * 
     * @return string|null
     */
    public function getHttp(): ?string {
        return $this->http;
    }
}