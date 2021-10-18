<?php

namespace Xofttion\Routing;

use Illuminate\Routing\Router;

class Mapper
{
    
    // Métodos de la clase Mapper

    /**
     * 
     * @param Router $router
     * @param string $classController
     * @param array $middlewares
     * @return void
     */
    public static function reader(Router $router, string $classController, array $middlewares = null): void
    {
        Builder::getInstance()->reader($router, $classController, $middlewares);
    }
}