<?php

namespace Kernel\Components\Router;

use Kernel\Bootstrap\ServiceContainer;
use Kernel\Enum\RequestMethod;
use ReflectionException;

class Route
{
    private static string $requestPath;
    public static ServiceContainer $container;


    public static function middlewares(array $middlewares, callable $closure): void
    {
        foreach ($middlewares as $middleware) {
            $middleware();
        }

        $closure();
    }

    /**
     * @throws ReflectionException
     */
    public static function get(string $path, array $closure): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== RequestMethod::GET->value) {
            return;
        }

        self::basicRouteLogic($path, $closure);
    }

    /**
     * @throws ReflectionException
     */
    public static function post(string $path, array $closure): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== RequestMethod::POST->value) {
            return;
        }

        self::basicRouteLogic($path, $closure);
    }

    /**
     * @throws ReflectionException
     */
    public static function put(string $path, array $closure): void
    {
        if (($_SERVER['REQUEST_METHOD'] !== RequestMethod::PUT->value)) {
            return;
        }

        self::basicRouteLogic($path, $closure);
    }

    /**
     * @throws ReflectionException
     */
    public static function patch(string $path, array $closure): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== RequestMethod::PATCH->value) {
            return;
        }

        self::basicRouteLogic($path, $closure);
    }

    /**
     * @throws ReflectionException
     */
    public static function delete(string $path, array $closure): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== RequestMethod::DELETE->value) {
            return;
        }

        self::basicRouteLogic($path, $closure);
    }

    /**
     * @throws ReflectionException
     */
    private static function basicRouteLogic($path, $closure): void
    {
        if (empty(static::$requestPath)) {
            self::preparePath();
        }

        if ($path === self::$requestPath) {
            self::$container->call($closure[0], $closure[1]);

            die();
        }
    }

    private static function preparePath(): void
    {
        static::$requestPath = parse_url($_SERVER['REQUEST_URI'], 5);
    }

    public static function setContainer(ServiceContainer $container): void
    {
        static::$container = $container;
    }

    public static function default(callable $closure): void
    {
        $closure();
    }
}