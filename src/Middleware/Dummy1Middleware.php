<?php

namespace App\Middleware;

use Bit9\Middleware\MiddlewareStackInterface;
use Bit9\Middleware\MiddlewareInterface;
use Bit9\Middleware\RequestInterface;

class Dummy1Middleware implements MiddlewareInterface
{
    public function handle(RequestInterface $request, ?MiddlewareStackInterface $stack = null): RequestInterface
    {
        dump(__METHOD__);

        return $stack->next()->handle($request, $stack);
    }
}