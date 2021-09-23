<?php

require __DIR__ . '/vendor/autoload.php';

use App\Stamp\Stamp1;
use App\Stamp\Stamp2;
use Bit9\Middleware\Middleware;
use App\Middleware\Dummy1Middleware;
use App\Middleware\Dummy2Middleware;
use App\Middleware\Dummy3Middleware;
use Bit9\Middleware\Request;
use Symfony\Component\Stopwatch\Stopwatch;

class Message
{
    private string $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }
}

$stopwatch = new Stopwatch(true);

$middleware = (new Middleware([
    // you can use a nested middleware
    (new Middleware([
        new Dummy1Middleware(),
        new Dummy2Middleware(),
        new Dummy3Middleware()
    ]))->setStopwatch($stopwatch, 'middleware level 2'),

    // or just regular middlewares
    new Dummy1Middleware(),
    new Dummy2Middleware(),
    new Dummy3Middleware()
]))->setStopwatch($stopwatch, 'middleware level 1');

// execute a simple object
echo "--------------------------------------------\n";
$message = new Request(new Message('test'));
$middleware->handle($message);

// show the stoppwatch
dump($stopwatch->getSections());

// execute a object decorated with stamps
echo "--------------------------------------------\n";
$message = new Request(new Message('test'), [new Stamp1(), new Stamp2('')]);
$response = $middleware->handle($message);
dump($response);

// execute a object - different workflow (middleware #3 omitted) because of stamps
echo "--------------------------------------------\n";
$message = new Request(new Message('test2'), [new Stamp1(), new Stamp2('test')]);
$response = $middleware->handle($message);
dump($response);

