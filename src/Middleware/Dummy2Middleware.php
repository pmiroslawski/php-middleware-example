<?php

namespace App\Middleware;

use App\Stamp\Stamp2;
use Bit9\Middleware\MiddlewareInterface;
use Bit9\Middleware\MiddlewareStackInterface;
use Bit9\Middleware\RequestInterface;

class Dummy2Middleware implements MiddlewareInterface
{
    public function handle(RequestInterface $request, ?MiddlewareStackInterface $stack = null): RequestInterface
    {
        dump(__METHOD__);

        $stamps = $request->all(Stamp2::class)->getArrayCopy();
        if (!empty($stamps[0]) && $stamps[0]->name == 'test') {
            return $request;
        }

        return $stack->next()->handle($request, $stack);
    }
}