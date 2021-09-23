<?php

use Bit9\Middleware\Middleware;
use App\Middleware\AppendTestStampMiddleware;
use App\Middleware\Dummy1Middleware;
use Bit9\Middleware\Request;
use App\Stamp\TestStamp;
use Bit9\Middleware\RequestFlatStamps;

require __DIR__ . '/../vendor/autoload.php';

// create a request with one stamp of type TestStamp::class
$request = new RequestFlatStamps(['test'], [new TestStamp('original')]);
/**
    Bit9\Middleware\Request Object (
        [stamps:Bit9\Middleware\Request:private] => ArrayObject Object (
            [storage:ArrayObject:private] => Array (
                [App\Stamp\TestStamp] => ArrayObject Object (
                    [storage:ArrayObject:private] => Array (
                        [0] => App\Stamp\TestStamp Object (
                            [message:App\Stamp\TestStamp:private] => original
                        )
                    )
                )
            )
        )
        [request:Bit9\Middleware\Request:private] => Array (
            [0] => test
        )
    )
*/
dump($request);

// add a new stamp of type TestStamp::class
$request->with(new TestStamp('overwritten'));
/**
     Bit9\Middleware\Request Object (
         [stamps:Bit9\Middleware\Request:private] => ArrayObject Object (
             [storage:ArrayObject:private] => Array (
                 [App\Stamp\TestStamp] => ArrayObject Object (
                     [storage:ArrayObject:private] => Array (
                         [0] => App\Stamp\TestStamp Object (
                            [message:App\Stamp\TestStamp:private] => original
                         )
                         [1] => App\Stamp\TestStamp Object (
                            [message:App\Stamp\TestStamp:private] => overwritten
                         )
                     )
                 )
             )
         )
         [request:Bit9\Middleware\Request:private] => Array (
            [0] => test
         )
     )
 */
dump($request);

// overwrite all stamp of type TestStamp::class
$request->setStamp(new TestStamp('overwritten'));
/**
     Bit9\Middleware\Request Object (
         [stamps:Bit9\Middleware\Request:private] => ArrayObject Object (
             [storage:ArrayObject:private] => Array (
                 [App\Stamp\TestStamp] => ArrayObject Object (
                     [storage:ArrayObject:private] => Array (
                         [0] => App\Stamp\TestStamp Object (
                            [message:App\Stamp\TestStamp:private] => overwritten
                         )
                     )
                 )
             )
         )
         [request:Bit9\Middleware\Request:private] => Array (
            [0] => test
         )
     )
 */
dump($request);


// prepare middleware
$middleware = new Middleware([
    new Dummy1Middleware(),
    new AppendTestStampMiddleware(),
]);
$request = $middleware->handle($request);
dump($request);
