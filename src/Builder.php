<?php

namespace Xofttion\Routing;

use Illuminate\Routing\Route;
use Illuminate\Routing\Router;

class Builder {
    
    // Atributos de la clase Builder
    
    /**
     *
     * @var Builder 
     */
    private static $instance;

    // Constructor de la clase Builder
    
    private function __construct() {
        
    }

    // Métodos de la clase Builder
    
    /**
     * 
     * @return Builder
     */
    public static function getInstance(): Builder {
        if (is_null(self::$instance)) {
            self::$instance = new static(); // Instanciando Builder
        } 
        
        return self::$instance; // Retornando Builder
    }
    
    /**
     * 
     * @param Router $router
     * @param string $classController
     * @param array $middlewares
     * @return void
     */
    public function reader(Router $router, string $classController, array $middlewares = null): void {
        foreach ($this->mapperEndPoints($classController) as $endPoint) {
            $this->attach($router, $endPoint, $middlewares); // Adjuntando
        }
    }

    /**
     * 
     * @param Router $router
     * @param EndPoint $endPoint
     * @param array $middlewares
     * @return void
     */
    public function attach(Router $router, EndPoint $endPoint, array $middlewares = null): void {
        $this->createRoute($router, $endPoint)->middleware($this->getMiddlewares($endPoint, $middlewares));
    }

    /**
     * 
     * @param Router $router
     * @param array $endPoints
     * @param array $middlewares
     * @return void
     */
    public function attachCollection(Router $router, array $endPoints, array $middlewares = null): void {
        foreach ($endPoints as $endPoint) {
            $this->attach($router, $endPoint, $middlewares); // Adjuntando
        }
    }
    
    /**
     * 
     * @param string $classController
     * @return array
     */
    protected function mapperEndPoints(string $classController): array {
        $annotations = Reader::getInstance()->ofClass($classController);
        
        $endPoints   = array(); // Listado de API's EndPoints
        
        foreach ($annotations as $annotation) {
            $endPoint = new EndPoint(); // Instanciando EndPoint

            $endPoint->setController($classController);
            $endPoint->setFunction($annotation->getFunction());
            $endPoint->setHttp($annotation->getHttp());
            $endPoint->setRoute($annotation->getRoute());
            
            array_push($endPoints, $endPoint); // Adjuntando EndPoint
        }
        
        return $endPoints; // Retornando listado de EndPoints generados
    }

    /**
     * 
     * @param Router $router
     * @param EndPoint $endPoint
     * @return Route
     */
    protected function createRoute(Router $router, EndPoint $endPoint): Route {
        switch ($endPoint->getHttp()) {
            case (Method::POST)   : return $router->post($endPoint->getRoute(), $endPoint->getProcess());
                
            case (Method::GET)    : return $router->get($endPoint->getRoute(), $endPoint->getProcess());

            case (Method::PUT)    : return $router->put($endPoint->getRoute(), $endPoint->getProcess());

            case (Method::DELETE) : return $router->delete($endPoint->getRoute(), $endPoint->getProcess());
        }
    }
    
    /**
     * 
     * @param EndPoint $endPoint
     * @param array $middlewares
     * @return array
     */
    protected function getMiddlewares(EndPoint $endPoint, array $middlewares = null): array {
        return [];
    }
}