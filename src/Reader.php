<?php

namespace Xofttion\Routing;

use ReflectionClass;
use ReflectionMethod;

class Reader
{
    private const CHARS_CLEAN = [' ', '\r', '\n', '/**', '*/'];

    public static function controller(string $class): array
    {
        $reflection = new ReflectionClass($class);

        $annotations = [];

        foreach ($reflection->getMethods() as $method) {
            if (static::isGranted($class, $method)) {
                $annotations[] = static::method($method);
            }
        }

        return $annotations;
    }

    private static function isGranted(string $class, ReflectionMethod $method): bool
    {
        return ($method->class === $class) && ($method->isPublic());
    }

    protected static function method(ReflectionMethod $method): Annotation
    {
        $normalice = str_replace(static::CHARS_CLEAN, '', $method->getDocComment());

        $depured = trim(str_replace(['*'], ';', $normalice));

        $results = explode(';', substr($depured, strpos($depured, '@')));

        $methodName = $method->getName();

        foreach ($results as $element) {
            list($name, $value) = static::getProp($element);

            switch ($name) {
                case (Annotation::ROUTE):
                    $route = $value;
                    break;

                case (Annotation::HTTP):
                    $http = $value;
                    break;
            }
        }

        return new Annotation($methodName, $route, $http);
    }

    private static function getProp(string $element): array
    {
        $endName = strpos($element, '(');
        $startName = 0;

        $end = strpos($element, ')');
        $startValue = $endName + 1;
        $endValue = $end - $endName - 1;

        $name = substr($element, $startName, $endName);
        $value = substr($element, $startValue, $endValue);

        return [$name, $value];
    }
}
