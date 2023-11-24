<?php

namespace Kernel\Bootstrap;

use ReflectionClass;
use ReflectionException;

class ServiceContainer
{
    private const CONSTRACT_METHOD_NAME = '__construct';

    /**
     * @throws ReflectionException
     */
    public function call(string $className, string $methodName)
    {
        $reflectionClass = new ReflectionClass($className);

        $method = $reflectionClass->getMethod($methodName);

        $parameters = [];

        foreach ($method->getParameters() as $parameter) {
            $parameterType = $parameter->getType()->getName();

            $parameters[] = $this->initializeClass(new ReflectionClass($parameterType));
        }

        $instance = $this->initializeClass($reflectionClass);

        return $method->invokeArgs($instance, $parameters);
    }

    /**
     * @throws ReflectionException
     */
    public function initializeClass(ReflectionClass $reflectionClass) {
        if (!$reflectionClass->hasMethod(self::CONSTRACT_METHOD_NAME)) {
            return $reflectionClass->newInstance();
        }

        $parameters = [];

        foreach ($reflectionClass->getConstructor()->getParameters() as $parameter) {
            $parameterType = $parameter->getType()->getName();

            $parameters[] = $this->initializeClass(new ReflectionClass($parameterType));
        }

        return $reflectionClass->newInstanceArgs($parameters);
    }
}