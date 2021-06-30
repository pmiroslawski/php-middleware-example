<?php

require __DIR__ . '/vendor/autoload.php';

use App\Middleware\DummyHandler;
use App\Middleware\Dummy2Handler;
use Bit9\Middleware\Dispatcher;
use Bit9\Middleware\Letter\Envelope;
use App\Stamp\Stamp1;
use App\Stamp\Stamp2;

class Message
{
    private string $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }
}

$dispatcher = new Dispatcher([
    new DummyHandler(),
    new Dummy2Handler(),
]);

echo "--------------------------------------------\n";
$message = new Envelope(new Message('test'));
$dispatcher->dispatch($message);


echo "--------------------------------------------\n";
$message = new Envelope(new Message('test2'), [new Stamp1(), new Stamp2()]);
$dispatcher->dispatch($message);
