<?php

namespace Kernel\bootstrap;

use ReflectionClass;
use ReflectionException;
use RuntimeException;

class ServiceContainer
{
    private array $services = [];

    public function register(string $name, callable $resolver): void
    {
        $this->services[$name] = $resolver;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function get($name): mixed
    {
        if (isset($this->services[$name])) {
            return $this->services[$name]();
        }
        throw new RuntimeException("Service '$name' not found in the container.");
    }

    /**
     * @throws ReflectionException
     */
    public function call(string $className, string $methodName, array $additionalParameters = [])
    {
        $reflectionClass = new ReflectionClass($className);
        $method = $reflectionClass->getMethod($methodName);
        $parameters = [];
        echo 'Check';
        die();
//        foreach ($method->getParameters() as $parameter) {
//            $parameterName = $parameter->getName();
//
//            // Check if the parameter is provided in additional parameters
//            if (array_key_exists($parameterName, $additionalParameters)) {
//                $parameters[] = $additionalParameters[$parameterName];
//            } else {
//                // Resolve the dependency from the container
//                $parameters[] = $this->get($parameter->getClass()->name);
//            }
//        }
//
//        $instance = $reflectionClass->newInstance();
//        return $method->invokeArgs($instance, $parameters);
    }
}