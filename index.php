<?php

require __DIR__ . '/vendor/autoload.php';

use App\Stamp\Stamp1;
use App\Stamp\Stamp2;
use App\Middleware\Dummy1Handler;
use App\Middleware\Dummy2Handler;
use App\Middleware\Dummy3Handler;
use Bit9\Middleware\Dispatcher;
use Bit9\Middleware\Letter\Envelope;

class Message
{
    private string $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }
}

$dispatcher = new Dispatcher([
    new Dummy1Handler(),
    new Dummy2Handler(),
    new Dummy3Handler(),
]);

// execute a simple object
echo "--------------------------------------------\n";
$message = new Envelope(new Message('test'));
$dispatcher->dispatch($message);

// execute a object decorated with stamps
echo "--------------------------------------------\n";
$message = new Envelope(new Message('test'), [new Stamp1(), new Stamp2('')]);
$dispatcher->dispatch($message);


// execute a object - different workflow because of stamps
echo "--------------------------------------------\n";
$message = new Envelope(new Message('test2'), [new Stamp1(), new Stamp2('test')]);
$dispatcher->dispatch($message);
