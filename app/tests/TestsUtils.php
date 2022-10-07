<?php

namespace App\tests;

use ReflectionMethod;
use ReflectionProperty;
use ReflectionClass;

trait TestsUtils
{
    /**
     * getPrivateMethod
     *
     * @param  string $className
     * @param  string $methodName
     * @return ReflectionMethod
     */
    public function getPrivateMethod(string $className, string $methodName): ReflectionMethod
    {
        $reflector = new \ReflectionClass($className);
        $method = $reflector->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }


    /**
     * getPrivateProperty
     *
     * @param  mixed $className
     * @param  mixed $propertyName
     * @return ReflectionProperty
     */
    private function getPrivateProperty(string $className, string $propertyName): ReflectionProperty
    {
        $reflector = new ReflectionClass($className);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }
}
