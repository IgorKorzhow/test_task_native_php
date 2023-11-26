<?php

namespace Kernel\Components\Router;

interface IRouteRegister
{
    public function __invoke(): void;

    public function getMiddlewares(): array;

    public function callMiddlewares(): void;
}