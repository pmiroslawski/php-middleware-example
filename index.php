<?php

require __DIR__ . '/vendor/autoload.php';

use App\Stamp\Stamp1;
use App\Stamp\Stamp2;
use Bit9\Middleware\Middleware;
use Bit9\Middleware\Core\MiddlewareStack;
use Bit9\Middleware\Letter\Envelope;
use App\Middleware\Dummy1Middleware;
use App\Middleware\Dummy2Middleware;
use App\Middleware\Dummy3Middleware;

class Message
{
    private string $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }
}

$middleware = new Middleware([
    new Middleware([
        new Dummy1Middleware([
            new Dummy3Middleware()
        ]),
        new Dummy2Middleware(),
        new Dummy3Middleware()
    ]),
    new Dummy1Middleware(),
    new Dummy2Middleware(),
    new Dummy3Middleware()
]);

// execute a simple object
echo "--------------------------------------------\n";
$message = new Envelope(new Message('test'));
$middleware->handle($message);

// execute a object decorated with stamps
echo "--------------------------------------------\n";
$message = new Envelope(new Message('test'), [new Stamp1(), new Stamp2('')]);
$middleware->handle($message);


// execute a object - different workflow because of stamps
echo "--------------------------------------------\n";
$message = new Envelope(new Message('test2'), [new Stamp1(), new Stamp2('test')]);
$middleware->handle($message);
