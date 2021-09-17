<?php

namespace Xofttion\Routing;

use ReflectionClass;
use ReflectionMethod;

class Reader
{

    // Atributos de la clase Builder

    /**
     *
     * @var Reader 
     */
    private static $instance;

    // Constructor de la clase Reader

    private function __construct()
    {

    }

    // Métodos de la clase Reader

    /**
     * 
     * @return Reader
     */
    public static function getInstance(): Reader
    {
        if (is_null(self::$instance)) {
            self::$instance = new Reader();
        }

        return self::$instance;
    }

    /**
     * 
     * @param string $class
     * @return array
     */
    public function ofClass(string $class): array
    {
        $reflection = new ReflectionClass($class);

        $annotations = [];

        foreach ($reflection->getMethods() as $method) {
            if ($this->isGranted($class, $method)) {
                $annotations[] = $this->ofMethod($method);
            }
        }

        return $annotations;
    }

    /**
     * 
     * @param string $class
     * @param ReflectionMethod $method
     * @return bool
     */
    private function isGranted(string $class, ReflectionMethod $method): bool
    {
        return ($method->class === $class) && ($method->isPublic());
    }

    /**
     * 
     * @param ReflectionMethod $method
     * @return Annotation
     */
    protected function ofMethod(ReflectionMethod $method): Annotation
    {
        $characters = [" ", "\r", "\n", "/**", "*/"]; // Claves para normalizar

        $normalice = str_replace($characters, "", $method->getDocComment());

        $depured = trim(str_replace(["*"], ";", $normalice)); // Depurando 

        $results = explode(";", substr($depured, strpos($depured, "@")));

        $annotation = new Annotation();

        foreach ($results as $element) {
            $start = strpos($element, "("); // Posición inicial
            $end = strpos($element, ")"); // Posición final

            $key = substr($element, 0, $start);
            $value = substr($element, $start + 1, $end - $start - 1);

            switch ($key) {
                case (Annotation::ROUTE): {
                    $annotation->setRoute($value);
                    break;
                }

                case (Annotation::HTTP): {
                    $annotation->setHttp($value);
                    break;
                }
            }
        }

        $annotation->setFunction($method->getName());

        return $annotation;
    }
}