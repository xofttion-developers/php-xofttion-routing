<?php

namespace Xofttion\Routing;

use ReflectionClass;
use ReflectionMethod;

class Reader {
    
    // Atributos de la clase Builder
    
    /**
     *
     * @var Reader 
     */
    private static $instance;
    
    // Constructor de la clase Reader
    
    private function __construct() {
        
    }
    
    // Métodos de la clase Reader
    
    /**
     * 
     * @return Reader
     */
    public static function getInstance(): Reader {
        if (is_null(self::$instance)) {
            self::$instance = new Reader(); // Instanciando Reader
        } 
        
        return self::$instance; // Retornando Reader
    }
    
    /**
     * 
     * @param string $class
     * @return array
     */
    public function ofClass(string $class): array {
        $annotations = []; // Listado de anotiaciones de clase
        
        $reflection  = new ReflectionClass($class); 
    
        foreach ($reflection->getMethods() as $method) {
            if ($this->isGranted($class, $method)) {
                array_push($annotations, $this->ofMethod($method));
            }
        }
        
        return $annotations; // Retornando listado de anotaciones
    }
    
    /**
     * 
     * @param string $class
     * @param ReflectionMethod $method
     * @return bool
     */
    private function isGranted(string $class, ReflectionMethod $method): bool {
        return ($method->class === $class) && ($method->isPublic());
    }

    /**
     * 
     * @param ReflectionMethod $method
     * @return Annotation
     */
    protected function ofMethod(ReflectionMethod $method): Annotation {
        $characters = [" ", "\r", "\n", "/**", "*/"]; // Claves para normalizar
        
        $normalice  = str_replace($characters, "", $method->getDocComment());
        
        $depured    = trim(str_replace(["*"], ";", $normalice)); // Depurando 
        
        $results    = explode(";", substr($depured, strpos($depured, "@")));
        
        $annotation = new Annotation(); // Anotacion del método
        
        foreach ($results as $item) {
            $start = strpos($item, "("); // Posición inicial
            $end   = strpos($item, ")"); // Posición final
            
            $key   = substr($item, 0, $start); // Clave de anotación
            $value = substr($item, $start + 1, $end - $start -1);
            
            switch ($key) {
                case (Annotation::ROUTE) : $annotation->setRoute($value); break;
                case (Annotation::HTTP)  : $annotation->setHttp($value); break;
            }
        }
        
        $annotation->setFunction($method->getName()); // Función 
        
        return $annotation; // Retornando la anotación generada desde método
    }
}