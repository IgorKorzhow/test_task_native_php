<?php

namespace Kernel\Components\Middleware;

interface IMiddleware
{
    public function __invoke(): void;
}