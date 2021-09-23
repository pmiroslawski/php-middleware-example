<?php

namespace App\Stamp;

use Bit9\Middleware\Request\Stamp\StampInterface;

class TestStamp implements StampInterface
{
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }
}