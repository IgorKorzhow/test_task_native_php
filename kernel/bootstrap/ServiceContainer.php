<?php

namespace Kernel\bootstrap;

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

        if ($methodName === self::CONSTRACT_METHOD_NAME && !$reflectionClass->hasMethod($methodName)) {
            return $reflectionClass->newInstance();
        }

        $method = $reflectionClass->getMethod($methodName);

        $parameters = [];

        foreach ($method->getParameters() as $parameter) {
            $parameterType = $parameter->getType()->getName();

            $parameters[] = $this->call($parameterType, self::CONSTRACT_METHOD_NAME);
        }

        $instance = $reflectionClass->newInstance();

        return $method->invokeArgs($instance, $parameters);
    }
}