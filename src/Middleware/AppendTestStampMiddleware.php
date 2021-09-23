<?php

namespace App\Middleware;

use App\Stamp\Stamp1;
use Bit9\Middleware\MiddlewareInterface;
use Bit9\Middleware\MiddlewareStackInterface;
use Bit9\Middleware\RequestInterface;
use Bit9\Middleware\RequestFlatStampsInterface;
use App\Stamp\TestStamp;

class AppendTestStampMiddleware implements MiddlewareInterface
{
    public function handle(RequestInterface $request, ?MiddlewareStackInterface $stack = null): RequestInterface
    {
        $request->with(new TestStamp('stamp appended by ' . __METHOD__));

        return $stack->next()->handle($request, $stack);
    }
}