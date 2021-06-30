<?php

namespace App\Middleware;

use Bit9\Middleware\Core\MiddlewareInterface;
use Bit9\Middleware\Core\MiddlewareStackInterface;
use Bit9\Middleware\Letter\Envelope;

class DummyHandler implements MiddlewareInterface
{
    public function handle(Envelope $envelope, MiddlewareStackInterface $stack): Envelope
    {
        dump(__METHOD__);

        return $stack->next()->handle($envelope, $stack);
    }
}