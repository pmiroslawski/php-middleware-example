<?php

namespace App\Middleware;

use App\Stamp\Stamp2;
use Bit9\Middleware\Core\MiddlewareInterface;
use Bit9\Middleware\Core\MiddlewareStackInterface;
use Bit9\Middleware\Letter\Envelope;

class Dummy2Handler implements MiddlewareInterface
{
    public function handle(Envelope $envelope, MiddlewareStackInterface $stack): Envelope
    {
        dump(__METHOD__);
        $stamps = $envelope->all(Stamp2::class);
        dump($stamps);

        return $stack->next()->handle($envelope, $stack);
    }
}