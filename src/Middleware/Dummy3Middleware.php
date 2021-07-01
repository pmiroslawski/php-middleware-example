<?php

namespace App\Middleware;

use Bit9\Middleware\MiddlewareInterface;
use Bit9\Middleware\MiddlewareStackInterface;
use Bit9\Middleware\Request;

class Dummy3Middleware implements MiddlewareInterface
{
    public function handle(Request $request, ?MiddlewareStackInterface $stack = null): Request
    {
        dump(__METHOD__);

        return $stack->next()->handle($request, $stack);
    }
}